<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 17:52
 */

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