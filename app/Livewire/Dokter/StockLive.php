<?php

namespace App\Livewire\Dokter;

use Livewire\Component;
use App\Models\Drug;

class StockLive extends Component
{
    public $drugs;

    public function mount()
    {
        if (!auth()->user()->hasRole('dokter')) {
            abort(403, 'Unauthorized');
        }
        // With('batches') membawa info stok/sisa batch+expired
        $this->drugs = Drug::with(['batches' => function ($q) {
            $q->where('stock', '>', 0)->orderBy('expired_at');
        }])->get();
    }
    public function render()
    {
        return view('livewire.dokter.stock-live');
    }
}
