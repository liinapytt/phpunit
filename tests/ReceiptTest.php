<?php
namespace TDD\Test;
require "vendor\autoload.php";

//Define classes used
use PHPUnit\Framework\TestCase;
use TDD\Receipt;

//Add class ReceiptTest that extends am abstract TestCase class
class ReceiptTest extends TestCase {
    //Adding new method setUp that is used before every test method
    public function setUp() {
        $this->Receipt = new Receipt();
    }
    //Adding new method tearDown to let use test in isolation, erases Receipt from memory
    public function tearDown() {
        unset($this->Receipt);
    }
    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected) {
        $coupon = null;
        $output = $this->Receipt->total($items, $coupon);
        //Asserting testTotal expected value
        $this->assertEquals(
            $expected,
            $output,
            "The total sum should equal {$expected}"
        );
    }
    //Adding dataprovider function that lays out different input values
    public function provideTotal() {
        return [
            //Different inputs
            'inputs totaling 16' => [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
    }
    //Adding a function to sum the total with discount coupon with Arrange-Act-Assert
    public function testTotalAndCoupon() {
        //Add predefined variables to the method
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon);
        //Asserting predefined sum value
        $this->assertEquals(
            12,
            //Error message
            $output,
            'When summing the total should equal 12'
        );
    }

    //Adding a function for test totalling exception
    public function testTotalException() {
        $input = [0,2,5,8];
        //Add an exception coupon value, higher than 1.00
        $coupon = 1.20;
        //Using phpunit method expectException directly
        $this->expectException('BadMethodCallException');
        $this->Receipt->total($input, $coupon);
    }
        //Adding a mock method testPostTaxTotal that uses MockBuilder class and Arrange-Act-Assert
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

    // Adding a new method testTax according to Arrange-Act-Assert
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