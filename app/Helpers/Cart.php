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
        $this->updateTotals();
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

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (array_key_exists($product->id, $this->items)) {
            $this->items[$product->id]['quantity'] += $quantity;
        } else {
            $this->items[$product->id] = $item;
        }

        session(['cart' => $this->items]);
        $this->updateTotals();
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
    public function removeAll()
    {
        session(['cart' => []]);
        $this->updateTotals();
    }
    public function clearCart()
    {
        session()->forget('cart');
        $this->updateTotals();
    }
    public function remove($productID)
    {
        if (array_key_exists($productID, $this->items)) {
            unset($this->items[$productID]);
            session(['cart' => $this->items]);
            $this->updateTotals();
        }
    }
    private function updateTotals()
    {
        $this->total_price = $this->getTotalPrice();
        $this->total_quantity = $this->getTotalQantity();
    }
}
