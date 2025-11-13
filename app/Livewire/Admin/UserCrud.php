<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Component
{
    public $users;
    public $name, $email, $password, $role, $userId;

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $this->getUsers();
    }

    public function getUsers()
    {
        $this->users = User::all();
    }

    public function createUser()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);
        $this->reset(['name', 'email', 'password', 'role']);
        $this->getUsers();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function updateUser()
    {
        if ($this->userId) {
            $user = User::find($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                // password opsional diganti berdasarkan input lebih lanjut...
            ]);
            $this->reset(['userId', 'name', 'email', 'role']);
            $this->getUsers();
        }
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        $this->getUsers();
    }
    public function render()
    {
        return view('livewire.admin.user-crud')->layout('components.layouts.admin');
    }
}
