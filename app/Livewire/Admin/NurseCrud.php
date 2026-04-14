<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NurseCrud extends Component
{
    public $nurses;
    public $name, $email, $password, $userId;

    public function mount()
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }
        $this->getNurses();
    }

    public function getNurses()
    {
        $this->nurses = User::where('role', 'perawat')->get();
    }

    public function createNurse()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'perawat',
            'clinic_id' => auth()->user()->clinic_id,
        ]);
        $this->reset(['name', 'email', 'password']);
        $this->getNurses();
    }

    public function render()
    {
        return view('livewire.admin.nurse-crud')->layout('components.layouts.admin');
    }
}
