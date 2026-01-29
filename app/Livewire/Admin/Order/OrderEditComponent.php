<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Order edit')]
#[Layout('components.layouts.admin')]
class OrderEditComponent extends Component
{   
    public Order $order;
    public bool $status;

    public function updatedStatus(){
        $this->order->setAttribute('status', $this->status)->save();
        $this->dispatch('status-changed');
    }

    public function mount(Order $order){
        $this->order = $order;
        $this->status = $order->status;
    }
    public function render()
    {
        return view('livewire.admin.order.order-edit-component');
    }
}
