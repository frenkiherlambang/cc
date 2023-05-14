<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserBalance extends Component
{

    public $userBalance = 0;
    public function render()
    {
        $this->userBalance = auth()->user()->balance;
        return view('livewire.user-balance');
    }
}
