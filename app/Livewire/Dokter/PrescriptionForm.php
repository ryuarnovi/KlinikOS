<?php

namespace App\Livewire\Dokter;

use Livewire\Component;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Illuminate\Support\Facades\DB;

class PrescriptionForm extends Component
{
    public $patient_name;
    public $prescription_items = []; // setiap elemen: ['drug_id'=>, 'quantity'=>]
    public $drugs;

    public function mount()
    {
        if (!auth()->user()->hasRole('dokter')) {
            abort(403, 'Unauthorized');
        }
        $this->drugs = Drug::all();
        $this->prescription_items = [
            ['drug_id'=>'', 'quantity'=>''],
        ];
    }

    public function addItem()
    {
        $this->prescription_items[] = ['drug_id'=>'', 'quantity'=>''];
    }

    public function removeItem($index)
    {
        unset($this->prescription_items[$index]);
        $this->prescription_items = array_values($this->prescription_items);
    }

    public function savePrescription()
    {
        $this->validate([
            'patient_name' => 'required|string|max:255',
            'prescription_items.*.drug_id' => 'required|exists:drugs,id',
            'prescription_items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () {
            $prescription = Prescription::create([
                'doctor_id' => auth()->id(), // pastikan login sebagai dokter
                'patient_name' => $this->patient_name,
                'status' => 'pending',
            ]);

            foreach ($this->prescription_items as $item) {
                PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'drug_id' => $item['drug_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        });

        // Reset agar siap input resep baru
        $this->patient_name = '';
        $this->prescription_items = [['drug_id'=>'', 'quantity'=>'']];
        $this->dispatch('toast', type:'success', message:'Resep berhasil dikirim ke kasir');
    }
    public function render()
    {
        return view('livewire.dokter.prescription-form');
    }
}
