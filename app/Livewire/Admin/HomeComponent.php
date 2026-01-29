<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('components.layouts.admin')]
class HomeComponent extends Component
{
    public function render()
    {
        $products_cnt = Product::count();
        $users_cnt = User::count();
        $orders_cnt = Order::count();
        $orders_total = Order::sum('total');
        return view('livewire.admin.home-component',
         compact('products_cnt', 'users_cnt', 'orders_cnt', 'orders_total'));
    }
}
