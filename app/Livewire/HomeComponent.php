<?php

namespace App\Livewire;

use App\Helpers\Traits\CartTrait;
use App\Helpers\Traits\WishTrait;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class HomeComponent extends Component
{
    use CartTrait, WishTrait;


    #[On('wish-updated')]
    public function render()
    {
        $hits_products = Product::orderBy('id', 'desc')->where('is_hit', '=', 1)->limit(12)->get();
        $new_products = Product::orderBy('id', 'desc')->where('is_new', '=', 1)->limit(6)->get();
        return view('livewire.home-component', [
            'title' => 'Home',
            'desc' => 'Description of home page',
            'hits_products' => $hits_products,
            'new_products' => $new_products,
        ]);
    }
}
