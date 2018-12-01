<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 22:08
 */

namespace App;

/**
 * Class Customer
 * @package App
 */
class Customer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals;

    /**
     * Customer constructor.
     * @param $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param Rental $args
     */
    public function addRental(Rental $args): void
    {
        $this->rentals[] = $args;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function statement(): string
    {
        $frequentRenterPoints = 0;
        $result = "Rental Record for {$this->getName()}\n";

        foreach ($this->rentals as $each) {
            //レンタルポイントを加算
            $frequentRenterPoints = $each->getFrequentRenterPoints();

            $result .= "{$each->getMovie()->getTitle()} {$each->getCharge()}\n";
        }

        $result .= "Amount owed is {$this->getTotalCharge()}\n";
        $result .= "You earned {$frequentRenterPoints} frequent renter points\n";
        return $result;
    }

    /**
     * @return float
     */
    private function getTotalCharge(): float
    {
        $totalAmount = 0;

        foreach ($this->rentals as $each) {
            $totalAmount += $each->getCharge();
        }
        return $totalAmount;
    }
}