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
}

class ChildrenPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::CHILDRENS;
    }
}

class NewReleasePrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::NEW_RELEASE;
    }
}

class RegularPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::REGULAR;
    }
}