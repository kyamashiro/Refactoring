<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/11/29
 * Time: 21:57
 */

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 2;
    const NEW_RELEASE = 2;

    private $title;
    private $price_code;

    /**
     * Movie constructor.
     * @param $title
     * @param $price_code
     */
    public function __construct($title, $price_code)
    {
        $this->title = $title;
        $this->price_code = $price_code;
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
        return $this->price_code;
    }

    /**
     * @param mixed $price_code
     */
    public function setPriceCode($price_code)
    {
        $this->price_code = $price_code;
    }


}