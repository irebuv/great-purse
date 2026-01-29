<?php

namespace App\Helpers\Traits;

use App\Helpers\Wish\Wish;
use Illuminate\Support\Facades\Auth;

trait WishTrait
{
    use CartTrait;
    public function add2Wish(int $productId)
    {
        Wish::add2Wish($productId);
        $this->dispatch('wish-updated');

        if (!Auth::user()) {
        if (count(Wish::activeWishProduct()) == 1) {
            $this->js("toastr.warning('For the wish list to work correctly, please log in!!')");
        }}
    }
    
    public function removeFromWish(int $productId){
        if (Wish::removeFromWish($productId)) {
            $this->js("toastr.success('Product removed from wishlist successfully')");
            $this->dispatch('wish-updated');
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }
    
    public function clearWish()
    {
        if(Wish::clearWish()){
            $this->js("toastr.success('Wishlist is empty now!')");
            $this->dispatch('wish-updated');
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }
}
