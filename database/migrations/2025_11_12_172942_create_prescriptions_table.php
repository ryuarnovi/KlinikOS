<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users');
            $table->string('patient_name');
            $table->enum('status', ['pending', 'confirmed', 'paid'])->default('pending');
            $table->foreignId('confirmed_by')->nullable()->constrained('users');
            $table->decimal('total', 12, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('prescriptions'); }
};
