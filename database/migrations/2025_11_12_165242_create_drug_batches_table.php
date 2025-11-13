<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drug_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id')->constrained('drugs');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->string('batch_number');
            $table->date('expired_at');
            $table->decimal('purchase_price', 12, 2);
            $table->integer('quantity'); // total masuk batch
            $table->integer('stock');    // sisa stok di batch ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drug_batches');
    }
};