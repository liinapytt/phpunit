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
}