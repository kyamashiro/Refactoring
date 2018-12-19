<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/14
 * Time: 0:26
 */

namespace HideDelegate;

class Department
{
    /**
     * @var string
     */
    private $chargeCode;
    /**
     * @var Person
     */
    private $manager;

    /**
     * Department constructor.
     * @param $manager
     */
    public function __construct(Person $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Person
     */
    public function getManager(): Person
    {
        return $this->manager;
    }
}