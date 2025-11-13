<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\DrugBatch;
use App\Models\InventoryLog;

class DrugOut extends Component
{
    public $batches;
    public $batch_id, $quantity, $note;
    public $rules = [
        'batch_id' => 'required|exists:drug_batches,id',
        'quantity' => 'required|integer|min:1',
        'note' => 'nullable|string',
    ];

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $this->batches = DrugBatch::where('stock', '>', 0)->get();
    }

    public function manualStockOut()
    {
        $batch = DrugBatch::findOrFail($this->batch_id);
        $qty = min($batch->stock, $this->quantity);
        $batch->decrement('stock', $qty);

        InventoryLog::create([
            'drug_batch_id' => $this->batch_id,
            'type' => 'out',
            'quantity' => $qty,
            'note' => $this->note,
        ]);

        $this->reset(['batch_id', 'quantity', 'note']);
        $this->batches = DrugBatch::where('stock', '>', 0)->get();
    }

    public function render()
    {
        return view('livewire.admin.drug-out')->layout('components.layouts.admin');
    }
}
