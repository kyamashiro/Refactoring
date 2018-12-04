<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/04
 * Time: 22:25
 */

namespace App;

class NewReleasePrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::NEW_RELEASE;
    }

    public function getCharge(int $daysRented): float
    {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        //Priceクラスのメソッドをオーバーライド
        //新作を2日以上レンタルでボーナスポイント
        return $daysRented > 1 ? 2 : 1;
    }
}