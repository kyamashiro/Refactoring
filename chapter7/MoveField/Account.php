<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 17:52
 */

namespace MoveField;

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