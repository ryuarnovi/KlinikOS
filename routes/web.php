<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('livewire.admin.dashboard');
        })->name('admin.dashboard');
    Route::get('/admin/supplier', \App\Livewire\Admin\SupplierCrud::class)->name('livewire.admin.supplier');
    Route::get('/admin/drug', \App\Livewire\Admin\DrugCrud::class)->name('livewire.admin.drug-crud');
    Route::get('/admin/drugin', \App\Livewire\Admin\DrugIn::class)->name('livewire.admin.drug-in');
    Route::get('/admin/drugout', \App\Livewire\Admin\DrugOut::class)->name('livewire.admin.drug-out');
    Route::get('/admin/report', \App\Livewire\Admin\Report::class)->name('livewire.admin.report');
    Route::get('/admin/users', \App\Livewire\Admin\UserCrud::class)->name('livewire.admin.users.index');
    });

    Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('prescriptions', \App\Livewire\Kasir\PrescriptionQueue::class)->name('kasir.prescriptions');
    Route::get('prescriptions/{id}/confirm', \App\Livewire\Kasir\PrescriptionConfirm::class)->name('kasir.prescription.confirm');
    });

    Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('stock', \App\Livewire\Dokter\StockLive::class)->name('dokter.stock');
    Route::get('resep', \App\Livewire\Dokter\PrescriptionForm::class)->name('dokter.resep');
    });
});
