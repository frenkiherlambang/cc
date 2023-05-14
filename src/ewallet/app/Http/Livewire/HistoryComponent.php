<?php

namespace App\Http\Livewire;

use App\Models\BalanceHistory;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryComponent extends Component
{

    use WithPagination;

    protected $listeners = ['echo:update-balance,.update-balance' => 'refreshHistory'];

    public function refreshHistory()
    {
        $this->render();
    }
    public function render()
    {
        $balanceHistories = BalanceHistory::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        return view('livewire.history-component', compact('balanceHistories'));
    }
}
