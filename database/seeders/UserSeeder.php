<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.test',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Dokter Klinik',
            'email' => 'dokter@klinik.test',
            'role' => 'dokter',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Kasir Klinik',
            'email' => 'kasir@klinik.test',
            'role' => 'kasir',
            'password' => Hash::make('password'),
        ]);
    }
}