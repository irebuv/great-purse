<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public string $enter;
    public string $password;

    public function login()
    {
        $validated = $this->validate([
            'enter' => 'required',
            'password' => 'required',
        ]);
        $log = filter_var($this->enter, FILTER_VALIDATE_EMAIL);

        if ($log) {
            $validated = [
                'email' => $this->enter,
                'password' => $this->password,
            ];
        } else {
            $validated = [
                'name' => $this->enter,
                'password' => $this->password,
            ];
        }

        if (Auth::attempt($validated)) {
            session()->flash('success', 'Login successful');
            $this->redirectRoute('account', navigate: true);
        } else {
            $this->js("toastr.error('Login failed')");
            $this->reset();
        }
    }
    public function render()
    {
        return view('livewire.user.login-component', [
            
            'title' => 'Login',
        ]);
    }
}
