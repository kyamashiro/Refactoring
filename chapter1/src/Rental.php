<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 22:05
 */

namespace App;
class Rental
{
    private $movie;
    private $daysRented;

    /**
     * Rental constructor.
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function getDaysRented(): int
    {
        return $this->daysRented;
    }

    public function getFrequentRenterPoints()
    {
        //新作を2日以上レンタルでボーナスポイント
        if ($this->getMovie()->getPriceCode() === Movie::NEW_RELEASE && $this->getDaysRented() > 1) {
            return 2;
        } else {
            return 1;
        }
    }
}