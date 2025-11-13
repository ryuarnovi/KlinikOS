<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Supplier;

class SupplierCrud extends Component
{
    public $suppliers;
    public $name, $contact, $address, $supplierId;
    public $rules = [
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $this->getSuppliers();
    }

    public function getSuppliers()
    {
        $this->suppliers = Supplier::all();
    }

    public function createSupplier()
    {
        Supplier::create([
            'name' => $this->name,
            'contact' => $this->contact,
            'address' => $this->address,
        ]);
        $this->reset(['name', 'contact', 'address']);
        $this->getSuppliers();
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplierId = $supplier->id;
        $this->name = $supplier->name;
        $this->contact = $supplier->contact;
        $this->address = $supplier->address;
    }

    public function updateSupplier()
    {
        if ($this->supplierId) {
            $supplier = Supplier::find($this->supplierId);
            $supplier->update([
                'name' => $this->name,
                'contact' => $this->contact,
                'address' => $this->address,
            ]);
            $this->reset(['supplierId', 'name', 'contact', 'address']);
            $this->getSuppliers();
        }
    }

    public function deleteSupplier($id)
    {
        Supplier::destroy($id);
        $this->getSuppliers();
    }

    public function render()
    {
        return view('livewire.admin.supplier-crud')->layout('components.layouts.admin');
    }
}
