<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('User edit')]
#[Layout('components.layouts.admin')]
class UserEditComponent extends Component
{
    use WithPagination;
    public User $user;
    public $name;
    public $email;
    public $password;
    public $number;
    public bool $is_admin;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->number = $user->number;
        $this->is_admin = $user->is_admin;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'password' => 'nullable|min:6',
            'is_admin' => 'boolean',
            'number' => 'required|min:6|unique:users,number,' . $this->user->id,
            'email' => 'required|max:255|email|unique:users,email,' . $this->user->id,
        ]);

        $this->user->name = $validated['name'];
        $this->user->number = $validated['number'];
        $this->user->email = $validated['email'];
        $this->user->is_admin = $validated['is_admin'];
        if ($validated['password']) {
            $this->user->password = $validated['password'];
        }

        $this->user->save();
        session()->flash('success', 'User updated successfully!');
        $this->redirectRoute('admin.users.index', navigate: true);
    }

    public function render()
    {
        $user_orders = $this->user->orders()->paginate(30);
        return view('livewire.admin.user.user-edit-component', compact('user_orders'));
    }
}
