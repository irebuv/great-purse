<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class RegisterComponent extends Component
{
    public string $name;
    public string $email;
    public string $number;
    public string $password;

    public function save(){
        $validated = $this->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'number' => 'required|max:20|min:8|unique:users,number',
            'password' => 'required|min:6',
        ]);
        
        $user = User::create($validated);

        session()->flash('success', 'Thanks for registration');
        $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.register-component', [  
            'title' => 'Register',
        ]);
    }
}
