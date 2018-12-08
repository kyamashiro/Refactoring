<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/08
 * Time: 18:23
 */

namespace ExtractClass;

class Person
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TelephoneNumber
     */
    private $officeTelephone;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return TelephoneNumber
     */
    public function getOfficeTelephone(): TelephoneNumber
    {
        return $this->officeTelephone;
    }

    /**
     * @return string
     */
    public function getTelephoneNumber(): string
    {
        return $this->officeTelephone->getTelephoneNumber();
    }
}