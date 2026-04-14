<?php

namespace App\Livewire\Antrean;

use Livewire\Component;
use App\Models\Queue;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class QueueManager extends Component
{
    public $queues;
    public $type = 'pendaftaran';

    public function mount()
    {
        $this->getQueues();
    }

    public function getQueues()
    {
        $this->queues = Queue::where('clinic_id', Auth::user()->clinic_id)
            ->where('type', $this->type)
            ->orderBy('position')
            ->get();
    }

    public function next($queueId)
    {
        $queue = Queue::findOrFail($queueId);
        $queue->status = 'in_progress';
        $queue->save();
        $this->getQueues();
    }

    public function refer($queueId, $referralType)
    {
        $queue = Queue::findOrFail($queueId);
        $queue->status = 'referred';
        $queue->type = $referralType;
        $queue->save();
        $this->getQueues();
    }

    public function render()
    {
        return view('livewire.antrean.queue-manager');
    }
}
