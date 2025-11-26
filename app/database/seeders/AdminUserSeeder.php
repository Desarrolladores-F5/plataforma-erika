<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'contacto@erikaherrera.cl'], // correo real de Erika
            [
                'name' => 'Erika Herrera',
                'password' => Hash::make('Admin123!'),  // luego se la cambias
                'role' => 'admin',
                'email_verified_at' => now()
            ]
        );
    }
}
