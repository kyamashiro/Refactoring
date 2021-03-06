<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 12:05
 */
namespace MoveMethod;

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