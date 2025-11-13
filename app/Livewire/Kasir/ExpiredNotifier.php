<?php

namespace App\Livewire\Kasir;

use Livewire\Component;
use App\Models\DrugBatch;
use Carbon\Carbon;

class ExpiredNotifier extends Component
{
    public $expiringBatches;

    public function mount()
    {
        if (!auth()->user()->hasRole('kasir')) {
            abort(403, 'Unauthorized');
        }
        $this->expiringBatches = DrugBatch::where('stock', '>', 0)
            ->where('expired_at', '<=', Carbon::now()->addDays(30))
            ->with('drug')
            ->get();
        $this->dispatch('toast', type: 'error', message: 'Stok tidak cukup');
    }

}
