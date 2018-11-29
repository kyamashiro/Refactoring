<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 22:05
 */

class Rental
{
    private $movie;
    private $days_rented;

    /**
     * Rental constructor.
     * @param $movie
     * @param $days_rented
     */
    public function __construct(Movie $movie, int $days_rented)
    {
        $this->movie = $movie;
        $this->days_rented = $days_rented;
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
        return $this->days_rented;
    }


}