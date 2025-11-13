<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\DrugBatch;
use Carbon\Carbon;

class ExpiredNotifier extends Component
{
    public $expiringBatches;

    public function mount()
    {
        $this->expiringBatches = DrugBatch::where('stock', '>', 0)
            ->where('expired_at', '<=', Carbon::now()->addDays(30))
            ->with('drug')
            ->get();
    }
    public function render()
    {
        return view('livewire.admin.components.expired-notifier')->layout('livewire.admin.layouts.admin');
    }
}
