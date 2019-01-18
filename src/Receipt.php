<?php
namespace TDD;

//Import BadMethodCallException
use \BadMethodCallException;

class Receipt {
    // Adding coupon calculation to total
    public function total(array $items = [], $coupon) {
        //Check if coupon is greater tha 1.00
        if ($coupon > 1.00) {
            //then call an error message
            throw new BadMethodCallException('Coupon must be less than or equal to 1.00');
        }
        $sum = array_sum($items);
        if (!is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }
        return $sum;
    }
    //Adding a method tax that calculates the tax sum
    public function tax($amount, $tax) {
        return ($amount * $tax);
    }

    //Adding method that posts the total sum of tax
    public function postTaxTotal($items, $tax, $coupon) {
        $subtotal = $this->total($items, $coupon);
        return $subtotal + $this->tax($subtotal, $tax);
    }
}
