<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 21:57
 */

namespace App;
class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private $title;
    private $priceCode;

    /**
     * Movie constructor.
     * @param $title
     * @param $priceCode
     */
    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->setPriceCode($priceCode);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPriceCode()
    {
        return $this->priceCode;
    }

    /**
     * @param mixed $priceCode
     */
    public function setPriceCode($priceCode)
    {
        $this->priceCode = $priceCode;
    }

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