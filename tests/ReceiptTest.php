<?php
namespace TDD\Test;
require "vendor\autoload.php";

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    //Adding new method setUp to provide instance of class
    public function setUp() {
        $this->Receipt = new Receipt();
    }
    //Adding new method tearDown to let out test in isolation
    public function tearDown() {
        unset($this->Receipt);
    }
    // Refactoring testTotal
    public function testTotal() {
        $input = [0,2,5,8];
        $coupon = null;
        $output = $this->Receipt->total($input, $coupon);
        //Asserting predefined value
        $this->assertEquals(
            15,
            //Error message
            $output,
            'Sum must be 15'
        );
    }
    //Adding a function to sum the total with discount coupon
    public function testTotalAndCoupon() {
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon);
        //Asserting predefined value
        $this->assertEquals(
            12,
            //Error message
            $output,
            'When summing the total should equal 12'
        );
    }
    //Adding a mock method testPostTaxTotal that uses MockBuilder class
    public function testPostTaxTotal() {
        //Add predefined variables to the method
        $items = [1,2,5,8];
        $tax = 0.20;
        $coupon = null;
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        $Receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));
        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }

    // Adding a new method testTax according to Add-Act-Assert
    public function testTax() {
        $inputAmount = 10.00;
        $taxInput = 0.10;
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
            1.00,
            $output,
            'The tax calculation should equal 1.00'
        );
    }
}