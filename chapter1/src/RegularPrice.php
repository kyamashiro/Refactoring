<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/04
 * Time: 22:25
 */

namespace App;

class RegularPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::REGULAR;
    }

    public function getCharge(int $daysRented): float
    {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }
        return $result;
    }
}