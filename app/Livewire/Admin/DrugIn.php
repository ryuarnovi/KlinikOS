<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Drug;
use App\Models\Supplier;
use App\Models\DrugBatch;

class DrugIn extends Component
{
    public $drugBatches;
    public $suppliers;
    public $drugs;
    public $drug_id, $supplier_id, $batch_number, $expired_at, $purchase_price, $quantity;

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $this->drugs = Drug::all();
        $this->suppliers = Supplier::all();
        $this->drugBatches = DrugBatch::all();
    }

    public function createDrugBatch()
    {
        DrugBatch::create([
            'drug_id' => $this->drug_id,
            'supplier_id' => $this->supplier_id,
            'batch_number' => $this->batch_number,
            'expired_at' => $this->expired_at,
            'purchase_price' => $this->purchase_price,
            'quantity' => $this->quantity,
            'stock' => $this->quantity,
        ]);
        $this->reset(['drug_id','supplier_id','batch_number','expired_at','purchase_price','quantity']);
    }

    public function render()
    {
        return view('livewire.admin.drug-in')->layout('components.layouts.admin');
    }
}
