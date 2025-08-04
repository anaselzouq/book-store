<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public function render()
    {
        $count = Auth::check()
            ? Cart::where('user_id', Auth::id())->sum('quantity')
            : 0;

        return view('livewire.cart-count', ['count' => $count]);
    }

    protected $listeners = ['cartUpdated' => '$refresh'];
}

