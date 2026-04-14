<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        // 1. Patients Table
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->string('nik')->unique()->nullable();
            $table->string('name');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('blood_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 2. Medical Records (SOAP)
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            
            // SOAP Data
            $table->text('subjective')->comment('Pasien mengeluh...');
            $table->text('objective')->comment('Hasil pemeriksaan fisik...');
            $table->text('assessment')->comment('Diagnosa...');
            $table->text('plan')->comment('Rencana terapi...');

            // ICD Integration
            $table->string('icd10_code')->nullable()->comment('International Classification of Diseases 10');
            $table->string('icd9cm_code')->nullable()->comment('ICD-9 Clinical Modification (Tindakan)');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('patients');
    }
};
