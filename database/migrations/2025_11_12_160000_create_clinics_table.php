<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $root) {
            $root->id();
            $root->string('name');
            $root->string('slug')->unique();
            $root->string('address')->nullable();
            $root->string('phone')->nullable();
            $root->string('email')->nullable();
            $root->string('logo')->nullable();
            $root->boolean('is_active')->default(true);
            $root->json('settings')->nullable(); // For clinic-specific configs (colors, features)
            $root->timestamps();
            $root->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
