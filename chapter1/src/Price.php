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
}