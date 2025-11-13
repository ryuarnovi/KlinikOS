<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }
        // Any initialization logic can go here
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
