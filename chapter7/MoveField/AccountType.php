<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 17:59
 */

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