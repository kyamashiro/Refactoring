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
            $thisAmount = $this->amountFor($each);

            $frequentRenterPoints++;
            if (($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE)
                && $each->getDaysRented() > 1) {
                $frequentRenterPoints++;
            }

            $result .= "{$each->getMovie()->getTitle()} {$thisAmount}\n";
            $totalAmount += $thisAmount;
        }

        $result .= "Amount owed is {$totalAmount}\n";
        $result .= "You earned {$frequentRenterPoints} frequent renter points \n";
        return $result;
    }

    /**
     * @param $aRental
     * @return float|int
     */
    private function amountFor(Rental $aRental): float
    {
        $result = 0;

        switch ($aRental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($aRental->getDaysRented() > 2) {
                    $result += ($aRental->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $aRental->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($aRental->getDaysRented() > 3) {
                    $result += ($aRental->getDaysRented() - 3) * 1.5;
                }
                break;
        }
        return $result;
    }
}