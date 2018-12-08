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
     * @var string
     */
    private $officeAreaCode;
    /**
     * @var string
     */
    private $officeNumber;

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
     * @return string
     */
    public function getOfficeAreaCode(): string
    {
        return $this->officeAreaCode;
    }

    /**
     * @param string $officeAreaCode
     */
    public function setOfficeAreaCode(string $officeAreaCode): void
    {
        $this->officeAreaCode = $officeAreaCode;
    }

    /**
     * @return string
     */
    public function getOfficeNumber(): string
    {
        return $this->officeNumber;
    }

    /**
     * @param string $officeNumber
     */
    public function setOfficeNumber(string $officeNumber): void
    {
        $this->officeNumber = $officeNumber;
    }

    public function getTelephoneNumber(): string
    {
        return "({$this->officeAreaCode}){$this->officeNumber}";
    }
}