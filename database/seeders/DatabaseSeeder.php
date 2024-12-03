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
        // Jalankan seeder FormulirSeeder
        $this->call([
            FormulirSeeder::class,  // Pastikan FormulirSeeder sudah dibuat
        ]);
    }
}
