リファクタリングをする上でテストは頼みの綱｡テストの結果を見てバグが入ってしまわなかったを判断する｡リファクタリングの成功は良いテストを用意できるかで決まる｡

## メソッドの分割･再配置
* 抜き出そうとする部分でローカルなスコープを持つ変数に着目し､それらが新規に作られるメソッドの一時変数かパラメータにならないか検討する｡
* 変更されない変数についてはパラメータで渡すことができる｡変更される変数は注意を払う必要がある｡1つだけなら戻り値にできる｡

* 変数名はコードのキーポイント｡わかりやすくするために変数名の変更を躊躇してはいけない｡
> コンパイラが理解できるコードは誰にでも書ける｡優れたプログラマは､人間にとってわかりやすいコードを書く｡

* 一時変数は､不必要なパラメータをたくさん受け渡してしまう原因になるのでできるだけ取り除く｡
一時変数はメソッドの中だけで有効なので､長くて複雑なルーチンの原因となる｡

他のオブジェクトの属性を調べるswitch文を書くことは､常に間違いである｡switch文は他のオブジェクトについてではなく､自分自身について行うべき｡
```php
switch ($this->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($this->getDaysRented() > 2) {
                    $result += ($this->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $this->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($this->getDaysRented() > 3) {
                    $result += ($this->getDaysRented() - 3) * 1.5;
                }
                break;
        }
```

RentalクラスからMovieクラスに移動
```php
    public function getCharge(int $daysRented): float
    {
        $result = 0;

        switch ($this->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($daysRented > 2) {
                    $result += ($daysRented - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $daysRented * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($daysRented > 3) {
                    $result += ($daysRented - 3) * 1.5;
                }
                break;
        }
        return $result;
    }
```

なぜ貸出料金の計算をMovieクラスで行うのか?  
→映画の分類が追加される変更が予想されるから｡分類を変えたときの影響範囲をできるだけ小さくする｡  
そのため映画の分類をRentalオブジェクトに渡すのではなく､貸出期間をMovieオブジェクトに渡す  
getCharge()とgetTotalFrequentRenterPoints()をMovieクラスで処理をすることで､分類の変更によって影響を受ける2つの要素(料金とレンタルポイント)をまとめて当事者に任せることができる｡  


## Switch文のポリモーフィズムへの置き換え  
![diagram-3147769721547182912](https://user-images.githubusercontent.com/36433535/49449020-5ba3c680-f81d-11e8-9d49-e8bec43e7f00.png)  

Movieクラスは抽象クラスであるPriceに依存させる｡  
利用する側はPriceのサブクラスを知る必要はない｡  

料金体系が変わった場合でも､Priceのサブクラスを追加するか､各サブクラスで処理を変えればよいだけであり､変更が非常に簡単｡  
