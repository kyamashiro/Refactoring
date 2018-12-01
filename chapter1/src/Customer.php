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
     * @param $each
     * @return float|int
     */
    private function amountFor(Rental $each): float
    {
        $thisAmount = 0;

        switch ($each->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($each->getDaysRented() > 2) {
                    $thisAmount += ($each->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $each->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $thisAmount += 1.5;
                if ($each->getDaysRented() > 3) {
                    $thisAmount += ($each->getDaysRented() - 3) * 1.5;
                }
                break;
        }
        return $thisAmount;
    }
}