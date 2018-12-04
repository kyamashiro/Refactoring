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

    abstract function getCharge(int $daysRented): float;

    /**
     * @param int $daysRented
     * @return int
     */
    public function getFrequentRenterPoints(int $daysRented): int
    {
        //新作を2日以上レンタルでボーナスポイント
        if ($this->getPriceCode() === Movie::NEW_RELEASE && $daysRented > 1) {
            return 2;
        } else {
            return 1;
        }
    }
}