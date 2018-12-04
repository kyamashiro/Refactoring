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

    /**
     * @var string
     */
    private $title;
    /**
     * @var Price
     */
    private $price;

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
        return $this->price->getPriceCode();
    }

    /**
     * @param mixed $priceCode
     */
    public function setPriceCode(int $priceCode)
    {
        switch ($priceCode) {
            case Movie::REGULAR:
                $this->price = new RegularPrice();
                break;
            case Movie::NEW_RELEASE:
                $this->price = new NewReleasePrice();
                break;
            case Movie::CHILDRENS:
                $this->price = new ChildrenPrice();
                break;
            default:
                throw new \InvalidArgumentException("不正な料金コード");
        }
    }

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

    public function getCharge(int $dayRented): float
    {
        return $this->price->getCharge($dayRented);
    }
}