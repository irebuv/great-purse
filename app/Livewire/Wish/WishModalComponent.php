<?php

namespace App\Livewire\Wish;

use App\Helpers\Traits\WishTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class WishModalComponent extends Component
{
    use WishTrait;

    #[On('wish-updated')]
    public function render()
    {
        return view('livewire.wish.wish-modal-component');
    }
}
