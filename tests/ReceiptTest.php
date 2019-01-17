<?php
namespace TDD\Test;
require "vendor\autoload.php";

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    public function testTotal() {
        $Receipt = new Receipt();
        $this->assertEquals(
            14,
            $Receipt->total([0,2,5,8]),
            'Sum must be 15'
        );

}
}