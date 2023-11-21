<?php

namespace App\Helpers;

class Cart
{
    private $items = [];
    public $total_quantity = 0;
    public $total_price = 0;

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }

    public function list()
    {
        return $this->items;
    }

    public function add($product, $quantity = 1)
    {
        $item = [
            'productid' => $product->id,
            'price' => $product->Price,
            'name' => $product->Name,
            'image' => $product->thumb,
            'quantity' => $quantity
        ];
        $this->items[$product->id] = $item;
        session(['cart' => $this->items]);
    }

    public function getTotalPrice()
    {
        $total_price = 0;
        foreach ($this->items as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        return $total_price;
    }


    public function getTotalQantity()
    {
        $total_quantity = 0;
        foreach ($this->items as $item) {
            $total_quantity += $item['quantity'];
        }
        return $total_quantity;
    }
}
