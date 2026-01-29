<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;
use Livewire\Attributes\Computed;

trait CartTrait
{
    public $quantity = 1;
    public $quantities = [];
    public function mount()
    {
        if (!empty(session('cart'))) {
            $cart = session("cart");

            $targetKey = 'quantity';
            $cart_keys = [];

            foreach ($cart as $outerKey => $innerArray) {
                if (isset($innerArray[$targetKey])) {
                    $cart_keys[$outerKey] = $innerArray[$targetKey];
                }
            }

            $this->quantities = $cart_keys;
        }
    }
    
    public function decrementQuantityProduct(int $productId){
        if($this->quantity <= 1){
            $quant = 0;
        } else {
            $quant = 1;
        }
        $this->quantity = $this->quantity - $quant;
    }

    public function increaseQuantityProduct(int $productId){
        if($this->quantity >= 99){
            $quant = 0;
        } else {
            $quant = 1;
        }
        $this->quantity = $this->quantity + $quant;
    }

    public function updated()
    {
        foreach ($this->quantities as $productId => $quantity) {
            if (!is_numeric($quantity) || $quantity < 1) {
                $quantity = 1;
                $this->quantities[$productId] = 1;
            }
            if ($quantity > 99) {
                $quantity = 99;
                $this->quantities[$productId] = 99;
            }
            session(["cart.{$productId}.quantity" => $quantity]);
        }
    }

    public function increaseQuantity(int $productId)
    {
        $this->quantities[$productId] = $this->quantities[$productId] + 1;

        if ($this->quantities[$productId] >= 99) {
            $this->quantities[$productId] = 99;
        }

        $updated = false;
        if (Cart::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => $this->quantities[$productId]]);
            $updated = true;
        }
        $this->dispatch('cart-updated');
    }

    public function decrementQuantity(int $productId)
    {

        $this->quantities[$productId] = $this->quantities[$productId] - 1;

        if ($this->quantities[$productId] <= 1) {
            $this->quantities[$productId] = 1;
        }

        $updated = false;
        if (Cart::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => $this->quantities[$productId]]);
            $updated = true;
        }
        $this->dispatch('cart-updated');
    }



    // public function updateItemQuantity(int $productId, int $quantity)
    // {
    //     if ($quantity >= 999) {
    //         $quantity = 999;
    //     }
    //     if ($quantity <= 0) {
    //         $quantity = 1;
    //     }
    //     if (Cart::updateItemQuantity($productId, $quantity)) {
    //         $this->dispatch('cart-updated');
    //         $this->js("toastr.success('Quantity updated <br>successfully')");
    //     } else {
    //         $this->js("toastr.error('Error updating')");
    //     }
    // }
    public function add2Cart(int $productId, $quantity = false)
    {
        $quantity = $quantity ? (int)$this->quantity : 1;

        if ($quantity < 1 || $quantity > 99) {
            $quantity = 1;
        }

        if (Cart::add2Cart($productId, $quantity)) {
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Product added to cart successfully!')");
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }

    public function removeFromCart(int $productId): void
    {
        if (Cart::removeProductFromCart($productId)) {
            $this->js("toastr.success('Product removed from cart successfully')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }

    public function clearCart()
    {
        Cart::clearCart();
        $this->dispatch('cart-updated');
        $this->js("toastr.success('Cart was <br> cleared!')");
    }
}
