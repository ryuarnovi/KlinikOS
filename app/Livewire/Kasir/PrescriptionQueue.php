<?php

namespace App\Livewire\Kasir;

use Livewire\Component;
use App\Models\Prescription;

class PrescriptionQueue extends Component
{
    public $prescriptions;

    public function mount()
    {
        if (!auth()->user()->hasRole('kasir')) {
            abort(403, 'Unauthorized');
        }
        $this->prescriptions = Prescription::where('status', 'pending')->with('items.drug')->get();
    }

    public function render()
    {
        return view('livewire.kasir.prescription-queue');
    }
}
