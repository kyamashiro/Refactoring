<?php
ini_set('display_errors', "On");
require '../../vendor/autoload.php';
$customer = new App\Customer("Martin Fowler");
$customer->addRental(new \App\Rental(new \App\Movie("Kent Beck", 2), 5));
$result = $customer->statement();
echo $result;
?>