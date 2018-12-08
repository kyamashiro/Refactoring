<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 12:13
 */

class AccountType
{
    /**
     * @param int $daysOverdrawn
     * @return float
     */
    public function overdraftCharge(int $daysOverdrawn): float
    {
        if ($this->isPremium()) {
            $result = 10;
            if ($daysOverdrawn > 7) $result += ($daysOverdrawn - 7) * 0.85;
            return $result;
        } else {
            return $daysOverdrawn * 1.75;
        }
    }
}