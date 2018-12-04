<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/04
 * Time: 22:24
 */

namespace App;

class ChildrenPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::CHILDRENS;
    }
}