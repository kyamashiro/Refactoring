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