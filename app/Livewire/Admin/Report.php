<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Sale;
use App\Models\DrugBatch;
use App\Models\Drug;

class Report extends Component
{
    public $sales;
    public $stock;
    public $startDate, $endDate;

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $this->sales = Sale::latest()->get();
        $this->stock = Drug::with('batches')->get();
    }
    public function render()
    {
        return view('livewire.admin.report')->layout('components.layouts.admin');
    }
}
