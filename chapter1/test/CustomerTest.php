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

    public function testStatement_PriceCode_Regular_Days1()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::REGULAR), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 2\nAmount owed is 2\nYou earned 1 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_Regular_Days3()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::REGULAR), 3));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 3.5\nAmount owed is 3.5\nYou earned 1 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_NewRelease_Days1()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::NEW_RELEASE), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 3\nAmount owed is 3\nYou earned 1 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_NewRelease_Days2()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::NEW_RELEASE), 2));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 6\nAmount owed is 6\nYou earned 2 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_Children_Days1()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::CHILDRENS), 1));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 1.5\nAmount owed is 1.5\nYou earned 1 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_Children_Days4()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::CHILDRENS), 4));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck 3\nAmount owed is 3\nYou earned 1 frequent renter points\n";
        $this->assertEquals($str, $result);
    }

    public function testStatement_PriceCode_NewRelease_And_Children()
    {
        $customer = new App\Customer("Martin Fowler");
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck2", \App\Movie::NEW_RELEASE), 4));
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck2", \App\Movie::NEW_RELEASE), 1));
        $customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", \App\Movie::CHILDRENS), 4));
        $result = $customer->statement();
        $str = "Rental Record for Martin Fowler\nKent Beck2 12\nKent Beck2 3\nKent Beck 3\nAmount owed is 18\nYou earned 4 frequent renter points\n";
        $this->assertEquals($str, $result);
    }
}
