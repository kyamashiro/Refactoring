<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 12:05
 */

class Account
{
    /**
     * 口座の種類
     * @var
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