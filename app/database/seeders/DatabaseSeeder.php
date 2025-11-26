<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si en el futuro agregas más seeders, los vas sumando en este array
        $this->call(AdminUserSeeder::class);           
        
    }
}
