<?php

namespace App\Cart;

class Cart
{

    protected $vats;

    public $products = [];

    public function __construct($vats)
    {
        $this->vats = $vats;
    }


    public function getVatsPercentage()
    {
        return $this->vats / 100;
    }

    public function addProduct($product)
    {
        $this->products[] = $product;
    }


    public function getPorudctsCount()
    {
        return count($this->products);
    }


    public function calculateSubTotalPrice()
    {
        $subTotalPrice = 0;
        foreach ($this->products as $product) {
            $subTotalPrice += $product['price'] * $product['quantity'];
        }
        return $subTotalPrice;
    }


    public function calculateVats()
    {
        return $this->calculateSubTotalPrice() * $this->getVatsPercentage();
    }


    public function calculateTotalPrice()
    {
        return $this->calculateVats() - $this->calculateSubTotalPrice();
    }

    public function removeProduct($removedindex)
    {
       unset($this->products [$removedindex]);
    }
}
