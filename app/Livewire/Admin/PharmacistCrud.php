<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PharmacistCrud extends Component
{
    public $pharmacists;
    public $name, $email, $password, $userId;

    public function mount()
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }
        $this->getPharmacists();
    }

    public function getPharmacists()
    {
        $this->pharmacists = User::where('role', 'apoteker')->get();
    }

    public function createPharmacist()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'apoteker',
            'clinic_id' => auth()->user()->clinic_id,
        ]);
        $this->reset(['name', 'email', 'password']);
        $this->getPharmacists();
    }

    public function render()
    {
        return view('livewire.admin.pharmacist-crud')->layout('components.layouts.admin');
    }
}
