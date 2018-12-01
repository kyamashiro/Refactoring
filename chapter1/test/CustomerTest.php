<?php
/**
 * Created by PhpStorm.
 * User: ky
 * Date: 2018/12/01
 * Time: 22:59
 */

use App\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

    public function testStatement_price_code_regular_days1()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 0), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 3\nAmount owed is 3\nYou earned 1 frequent renter points \n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_price_code_regular_days3()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 0), 3));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 9\nAmount owed is 9\nYou earned 2 frequent renter points \n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_price_code_new_release()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 1), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 3\nAmount owed is 3\nYou earned 1 frequent renter points \n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_price_code_children_days1()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 2), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 1.5\nAmount owed is 1.5\nYou earned 1 frequent renter points \n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_price_code_children_days4()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 2), 4));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 1.5\nAmount owed is 1.5\nYou earned 1 frequent renter points \n";
        $this->assertEquals($str, $result);
    }
}
