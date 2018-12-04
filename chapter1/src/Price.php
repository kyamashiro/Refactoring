<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/04
 * Time: 21:47
 */

namespace App;

abstract class Price
{
    abstract function getPriceCode(): int;

    /**
     * @param int $daysRented
     * @return float|int
     */
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
}