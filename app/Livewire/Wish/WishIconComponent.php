<?php

namespace App\Livewire\Wish;

use Livewire\Attributes\On;
use Livewire\Component;

class WishIconComponent extends Component
{
    #[On('wish-updated')]
    public function render()
    {
        return view('livewire.wish.wish-icon-component');
    }
}
