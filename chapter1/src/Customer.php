<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 22:08
 */

namespace App;

class Customer
{
    private $name;

    /**
     * @var Rental
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

    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $rentals = $this->rentals;
        $result = "Rental Record for {$this->getName()}\n";

        foreach ($rentals as $each) {
            $thisAmount = $each->getCharge();
            //レンタルポイントを加算
            $frequentRenterPoints++;
            //新作を二日以上借りた場合はボーナスポイント
            if (($each->getMovie()->getPriceCode() === Movie::NEW_RELEASE)
                && $each->getDaysRented() > 1) {
                $frequentRenterPoints++;
            }

            $result .= "{$each->getMovie()->getTitle()} {$thisAmount}\n";
            $totalAmount += $thisAmount;
        }

        $result .= "Amount owed is {$totalAmount}\n";
        $result .= "You earned {$frequentRenterPoints} frequent renter points\n";
        return $result;
    }
}