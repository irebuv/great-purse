<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('User create')]
#[Layout('components.layouts.admin')]
class UserCreateComponent extends Component
{
    public string $name;
    public string $email;
    public string $password;
    public string $number;
    public bool $is_admin = false;

    
    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:6',
            'is_admin' => 'boolean',
            'number' => 'required|min:6|unique:users,number',
            'email' => 'required|max:255|email|unique:users,email',
        ]);

        $user = new User();

        $user->name = $validated['name'];
        $user->password = $validated['password'];
        $user->number = $validated['number'];
        $user->email = $validated['email'];
        $user->is_admin = $validated['is_admin'];

        $user->save();
        session()->flash('success', 'User added successfully!');
        $this->redirectRoute('admin.users.index', navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.user.user-create-component');
    }
}
