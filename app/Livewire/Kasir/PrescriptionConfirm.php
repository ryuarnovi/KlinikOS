<?php

namespace App\Livewire\Kasir;

use Livewire\Component;
use App\Models\Prescription;
use App\Models\DrugBatch;
use App\Models\InventoryLog;
use App\Models\PrescriptionItem;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class PrescriptionConfirm extends Component
{
    public $prescription;

    public function mount($id)
    {
        if (!auth()->user()->hasRole('kasir')) {
            abort(403, 'Unauthorized');
        }
        $this->prescription = Prescription::with('items.drug')->findOrFail($id);
    }

    public function confirmPrescription()
    {
        DB::transaction(function () {
            $total = 0;
            foreach ($this->prescription->items as $item) {
                $qty = $item->quantity;
                $price = $item->drug->retail_price;
                $item->price_each = $price;
                $item->save();
                $total += $price * $qty;
                $qtyNeeded = $item->quantity;
                $totalQtyAvailable = DrugBatch::where('drug_id', $item->drug_id)
                ->where('stock', '>', 0)
                ->sum('stock');
                if ($qtyNeeded > $totalQtyAvailable) {
                    throw new \Exception('Stok obat ' . $item->drug->name . ' tidak mencukupi!');
                }

                // FEFO: keluarkan dari batch paling dulu expired
                $batches = DrugBatch::where('drug_id', $item->drug_id)
                    ->where('stock', '>', 0)
                    ->orderBy('expired_at')
                    ->get();

                foreach ($batches as $batch) {
                    if ($qty <= 0) break;
                    $take = min($batch->stock, $qty);

                    $batch->decrement('stock', $take);

                    InventoryLog::create([
                        'drug_batch_id' => $batch->id,
                        'type' => 'out',
                        'quantity' => $take,
                        'note' => 'Resep '.$this->prescription->id,
                    ]);
                    $qty -= $take;
                }
            }
            $this->prescription->update([
                'status' => 'paid',
                'total' => $total,
                'confirmed_by' => auth()->id(),
            ]);
            Sale::create([
                'invoice_no' => 'RS'.now()->format('YmdHis').$this->prescription->id,
                'sold_at' => now(),
                'total' => $total,
            ]);
        });
    }
    public function render()
    {
        return view('livewire.kasir.prescription-confirm');
    }
}
