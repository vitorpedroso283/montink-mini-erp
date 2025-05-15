<?php

namespace App\Livewire;

use Livewire\Component;

class CartWidget extends Component
{
    public $totalItems = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->totalItems = count(session('cart.items', []));
    }

    public function render()
    {
        return view('livewire.cart-widget');
    }
}
