<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formulir;

class FormulirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan factory untuk membuat data dummy
        Formulir::factory()->count(15)->create();
    }
}
