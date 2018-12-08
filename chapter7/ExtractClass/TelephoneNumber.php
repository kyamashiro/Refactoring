<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 18:24
 */

namespace ExtractClass;


class TelephoneNumber
{
    /**
     * @var string
     */
    private $areaCode;

    /**
     * @var string
     */
    private $number;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getAreaCode(): string
    {
        return $this->areaCode;
    }

    /**
     * @param string $areaCode
     */
    public function setAreaCode(string $areaCode): void
    {
        $this->areaCode = $areaCode;
    }

    public function getTelephoneNumber(): string
    {
        return "({$this->areaCode}){$this->number}";
    }
}