<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        User::updateOrCreate(
            ['email' => 'admin@olofpalme.com'],
            [
                'name' => 'Administrador Olof Palme',
                'password' => Hash::make('password123'), // Cambia esta contraseña en producción
            ]
        );
    }
}