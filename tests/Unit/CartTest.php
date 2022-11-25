<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Cart\Cart;

class CartTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cart_is_created_with_vats_successfully()
    {
        $cart = new Cart(14);

        $expected = 14 / 100;
        $actual = $cart->getVatsPercentage();

        $this->assertEquals($expected, $actual);
    }


     /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cart_add_products()
    {
        $cart = new Cart(14);

        $product = [
            'name' => 'IPHONE14',
            'price' => 15,
            'quantity' => 100
        ];

        $cart->addProduct($product);

        $expected_products_count = 1;

        $actual = $cart->getPorudctsCount();

        $this->assertEquals($expected_products_count, $actual);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cart_calculate_sub_total_price()
    {
        $cart = new Cart(14);

        $product1 = [
            'name' => 'IPHONE14',
            'price' => 15,
            'quantity' => 100
        ];

        $cart->addProduct($product1);

        $product2 = [
            'name' => 'Oppo Reno 7',
            'price' => 5,
            'quantity' => 3
        ];
        $cart->addProduct($product2);

        $expect_sub_total_price = (15 * 100) + (5 * 3);

        $actual = $cart->calculateSubTotalPrice();

        $this->assertEquals($expect_sub_total_price, $actual);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cart_calculate_vats_price()
    {
        $cart = new Cart(14);

        $product1 = [
            'name' => 'IPHONE14',
            'price' => 15,
            'quantity' => 100
        ];
        $cart->addProduct($product1);

        $product2 = [
            'name' => 'Oppo Reno 7',
            'price' => 5,
            'quantity' => 3
        ];
        $cart->addProduct($product2);

        $sub_total_price = (15 * 100) + (5 * 3);

        $expect_vats_price = $cart->getVatsPercentage() *  $sub_total_price;

        $actual = $cart->calculateVats();

        $this->assertEquals($expect_vats_price, $actual);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cart_calculate_total_price()
    {
        $cart = new Cart(14);

        $product1 = [
            'name' => 'IPHONE14',
            'price' => 15,
            'quantity' => 100
        ];
        $cart->addProduct($product1);

        $product2 = [
            'name' => 'Oppo Reno 7',
            'price' => 5,
            'quantity' => 3
        ];
        $cart->addProduct($product2);

        $sub_total_price = (15 * 100) + (5 * 3);

        $vats_price = $cart->getVatsPercentage() *  $sub_total_price;

        $expect_total_price = $sub_total_price +  $vats_price;
        
        $actual = $cart->calculateTotalPrice();

        $this->assertEquals($expect_total_price, $actual);
    }
}
