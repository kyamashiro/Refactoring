<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/14
 * Time: 0:25
 */

namespace HideDelegate;

class Person
{
    /**
     * @var Department
     */
    private $department;

    /**
     * @return Department
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }

    /**
     * @return Person
     */
    public function getManager(): Person
    {
        return $this->department->getManager();
    }
}