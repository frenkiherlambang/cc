<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Jobs\ProcessDeposit;
use App\Jobs\ProcessWithdrawal;
use Illuminate\Support\Facades\Queue;
use Ramsey\Uuid\Type\Decimal;

class CollectiveBank extends Component
{
    public $amount = 0;
    public $userBalance = 0;
    public $orderId;
    public $timestamp;

    protected $listeners = ['echo:update-balance,.update-balance' => 'updateBalance'];

    public function updateBalance($data)
    {
        // dd($data);
        // refresh balance
        $this->userBalance = $data['data']['userBalance'];
    }


    public function deposit()
    {
        $this->userBalance = auth()->user()->balance;
        $this->orderId = rand(1000, 9999);
        $this->timestamp = now()->timestamp;

        $user = auth()->user();
         // remove non numeric characters
         $this->amount = (float) preg_replace('/[^0-9.]/', '', $this->amount);

        ProcessDeposit::dispatch($user, $this->amount, $this->orderId, $this->timestamp);
        // sent notification to user
        session()->flash('message', 'Deposit request sent!');

    }

    public function withdrawal()
    {
        $this->userBalance = auth()->user()->balance;
        $this->orderId = rand(1000, 9999);
        $this->timestamp = now()->timestamp;
        $user = auth()->user();
        // remove non numeric characters
        $this->amount = (float) preg_replace('/[^0-9.]/', '', $this->amount);

       ProcessWithdrawal::dispatch($user, $this->amount, $this->orderId, $this->timestamp);
       // sent notification to user
       session()->flash('message', 'Withdrawal request sent!');
    }

    public function render()
    {
        return view('livewire.collective-bank');
    }
}
