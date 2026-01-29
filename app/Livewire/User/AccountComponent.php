<?php

namespace App\Livewire\User;

use App\Helpers\Traits\CartTrait;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AccountComponent extends Component
{
    use WithPagination;
    public string $name;
    public string $email;
    public string $number;
    public string $password;

    public function mount(){
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->number = auth()->user()->number;
    }

    public function change(){
        $user = User::findOrFail(auth()->id());

        $validated = $this->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'number' => 'required|max:20|min:8|unique:users,number,' . auth()->id(),
            'password' => 'nullable|min:6',
        ]);
        if (!$validated['password']){
            unset($validated['password']);
        }

        $user->update($validated);
        $this->js("toastr.success('Your account has been changed!')");
    }
    public function render()
    {
        $orders = Order::query()
            ->where('user_id', '=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('livewire.user.account-component', [
            'title' => 'Account',
            'orders' => $orders,
        ]);
    }
}
