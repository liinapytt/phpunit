<?php
namespace TDD;
class Receipt {
    public function total(array $items = []){
        return array_sum($items);
    }
    //Adding a method tax that calculates the tax sum
    public function tax($amount, $tax) {
        return ($amount * $tax);
    }
}
