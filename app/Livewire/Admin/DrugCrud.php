<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Drug;

class DrugCrud extends Component
{
    public $showModal = false;
    public $isEdit = false;

    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, "Unauthorized action.");
        }
    }

    public $drugs;
    public $drugId;
    public $name, $description, $function, $side_effect, $code, $category, $brand, $dose, $group, $form, $retail_price, $stock, $price;

    public function getDrugs()
    {
        $this->drugs = Drug::all();
    }

    // Tampilkan modal tambah
    public function showCreateModal()
    {
        $this->reset(['name', 'description', 'function', 'side_effect', 'code', 'category', 'brand', 'dose', 'group', 'form', 'retail_price', 'stock', 'price', 'drugId']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    // Tampilkan modal edit
    public function showEditModal($id)
    {
        $this->editDrug($id);
        $this->isEdit = true;
        $this->showModal = true;
    }

    // Tambah data obat
    public function createDrug()
    {
        Drug::create([
            'name' => $this->name,
            'description' => $this->description,
            'function' => $this->function,
            'side_effect' => $this->side_effect,
            'code' => $this->code,
            'category' => $this->category,
            'brand' => $this->brand,
            'dose' => $this->dose,
            'group' => $this->group,
            'form' => $this->form,
            'retail_price' => $this->retail_price,
            'stock' => $this->stock,
            'price' => $this->price,
        ]);
        $this->showModal = false;
        $this->resetExcept('drugs');
        $this->getDrugs();
    }

    public function editDrug($id)
    {
        $drug = Drug::findOrFail($id);
        $this->drugId = $drug->id;
        $this->name = $drug->name;
        $this->description = $drug->description;
        $this->function = $drug->function;
        $this->side_effect = $drug->side_effect;
        $this->code = $drug->code;
        $this->category = $drug->category;
        $this->brand = $drug->brand;
        $this->dose = $drug->dose;
        $this->group = $drug->group;
        $this->form = $drug->form;
        $this->retail_price = $drug->retail_price;
        $this->stock = $drug->stock;
        $this->price = $drug->price;
        $this->isEdit = true;
        $this->showModal = true;
    }

    // Update data obat
    public function updateDrug()
    {
        if ($this->drugId) {
            $drug = Drug::find($this->drugId);
            $drug->update([
                'name' => $this->name,
                'description' => $this->description,
                'function' => $this->function,
                'side_effect' => $this->side_effect,
                'code' => $this->code,
                'category' => $this->category,
                'brand' => $this->brand,
                'dose' => $this->dose,
                'group' => $this->group,
                'form' => $this->form,
                'retail_price' => $this->retail_price,
                'stock' => $this->stock,
                'price' => $this->price,
            ]);
            $this->showModal = false;
            $this->resetExcept('drugs');
            $this->getDrugs();
        }
    }

    public function deleteDrug($id)
    {
        Drug::destroy($id);
        $this->getDrugs();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isEdit = false;
        $this->reset(['name', 'description', 'function', 'side_effect', 'code', 'category', 'brand', 'dose', 'group', 'form', 'retail_price', 'stock', 'price']);
    }

    public function render()
    {
        $this->drugs = Drug::all();
        return view('livewire.admin.drug-crud')->layout('components.layouts.admin');
    }
}
