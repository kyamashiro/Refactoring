# 第7章 オブジェクト間での特性の移動
オブジェクトの設計の根幹は､責務をどこに配置するか｡責務をはじめから正しい場所に配置することは難しいため､リファクタリングを通して適切な場所に配置する｡

## メソッドの移動
あるクラスのメソッドが他のクラスから多用されているとき､そのメソッドを多用するクラスに移動･作成する｡
* 動機  
1. クラスの振る舞いが多い
2. クラス間のやり取りが多く結合度が高いとき

```php
class Account
{
    /**
     * 口座の種類
     * @var AccountType
     */
    private $type;
    /**
     * 当座貸越手数料
     * @var
     */
    private $daysOverdrawn;

    /**
     * @return float
     */
    public function overdraftCharge(): float
    {
        if ($this->type->isPremium()) {
            $result = 10;
            if ($this->daysOverdrawn > 7) $result += ($this->daysOverdrawn - 7) * 0.85;
            return $result;
        } else {
            return $this->daysOverdrawn * 1.75;
        }
    }

    /**
     * @return float
     */
    public function bankCharge(): float
    {
        $result = 4.5;
        if ($this->daysOverdrawn > 0) $result += $this->overdraftCharge();
        return $result;
    }
}
```
新たな口座の種類ができるとして口座の種類ごとに手数料を計算しなければならない場合､overdraftCharge()がAccountTypeクラスにへの結合度が高くなってしまうのでリファクタリングをする｡
口座の種類はAccountTypeで判断させるため､overdraftCharge()をAccountTypeクラスに移動する｡

```php
class Account
{
    /**
     * 口座の種類
     * @var AccountType
     */
    private $type;
    /**
     * 当座貸越手数料
     * @var
     */
    private $daysOverdrawn;

    /**
     * @return AccountType
     */
    public function getType(): AccountType
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDaysOverdrawn()
    {
        return $this->daysOverdrawn;
    }

    public function overdraftCharge()
    {
        return $this->type->overdraftCharge($this->daysOverdrawn);
    }

    /**
     * @return float
     */
    public function bankCharge(): float
    {
        $result = 4.5;
        if ($this->daysOverdrawn > 0) $result += $this->overdraftCharge();
        return $result;
    }
}
```

```php
class AccountType
{
    /**
     * @param Account $account
     * @return float
     */
    public function overdraftCharge(Account $account): float
    {
        if ($this->isPremium()) {
            $result = 10;
            if ($account->getdaysOverdrawn() > 7) $result += ($account->getdaysOverdrawn() - 7) * 0.85;
            return $result;
        } else {
            return $account->getdaysOverdrawn() * 1.75;
        }
    }
}
```

## フィールドの移動
ある週では正しく適正であった設計判断も､次の週にはそうではなくなる｡それ自体は問題ではなく､それについて何もしないことが問題｡リファクタリングを通して常に設計を修正する｡

* 動機  
1. そのクラスのメソッドよりも別のクラスのメソッドのほうがそのフィールドを多く使っているとわかったとき｡
2. クラスの抽出を行うため｡クラスの抽出を行う場合､先にフィールドを移動してからメソッドを移動させる｡

```php
class Account
{
    /**
     * @var AccountType
     */
    private $type;
    /**
     * 利率
     * @var
     */
    private $interestRate;

    /**
     * @param float $amount
     * @param int $days
     * @return float|int
     */
    public function interestForAmountDays(float $amount, int $days): float
    {
        return $this->interestRate * $amount * $days / 365;
    }
}
```

Accountクラスの$interestRateのフィールドをAccountTypeクラスに移動する｡interestForAmountDaysメソッドがこのフィールドを利用している｡

```php
class AccountType
{
    /**
     * @var float
     */
    private $interestRate;

    /**
     * @return mixed
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * @param mixed $interestRate
     */
    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }
}
```

```php
class Account
{
    /**
     * @var AccountType
     */
    private $type;

    /**
     * @param float $amount
     * @param int $days
     * @return float|int
     */
    public function interestForAmountDays(float $amount, int $days): float
    {
        return $this->type->getInterestRate() * $amount * $days / 365;
    }
}
```

Accountクラスの$interestRateフィールドを削除する｡

## クラスの抽出
｢クラスはきっちりと抽象化されたものであり､少数の明確な責務を担うべきである｣
実際には操作やデータを追加していくため､クラスは成長する｡
クラスに責務を少しずつ追加していき､やがて手におえないほどクラスは複雑に成長する｡｡｡

* 動機
1. クラスに大量のメソッドとデータがある｡

```php
class Person
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $officeAreaCode;
    /**
     * @var string
     */
    private $officeNumber;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getOfficeAreaCode(): string
    {
        return $this->officeAreaCode;
    }

    /**
     * @param string $officeAreaCode
     */
    public function setOfficeAreaCode(string $officeAreaCode): void
    {
        $this->officeAreaCode = $officeAreaCode;
    }

    /**
     * @return string
     */
    public function getOfficeNumber(): string
    {
        return $this->officeNumber;
    }

    /**
     * @param string $officeNumber
     */
    public function setOfficeNumber(string $officeNumber): void
    {
        $this->officeNumber = $officeNumber;
    }

    public function getTelephoneNumber(): string
    {
        return "({$this->officeAreaCode}){$this->officeNumber}";
    }
}
```

電話番号の振る舞いをクラスとして抽出する｡

```php
class Person
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TelephoneNumber
     */
    private $officeTelephone;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return TelephoneNumber
     */
    public function getOfficeTelephone(): TelephoneNumber
    {
        return $this->officeTelephone;
    }

    /**
     * @return string
     */
    public function getTelephoneNumber(): string
    {
        return $this->officeTelephone->getTelephoneNumber();
    }
}
```

```php
class TelephoneNumber
{
    /**
     * @var string
     */
    private $areaCode;

    /**
     * @var string
     */
    private $number;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getAreaCode(): string
    {
        return $this->areaCode;
    }

    /**
     * @param string $areaCode
     */
    public function setAreaCode(string $areaCode): void
    {
        $this->areaCode = $areaCode;
    }

    public function getTelephoneNumber(): string
    {
        return "({$this->areaCode}){$this->number}";
    }
}
```

