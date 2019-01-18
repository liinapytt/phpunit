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
        $output = $this->Receipt->total($input);
        $this->assertEquals(
            15,
            $output,
            'Sum must be 15'
        );
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