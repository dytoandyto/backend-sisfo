<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categories::create([
            'name_category' => 'Alat Olahraga',
            'description' => 'alat dari ruang olaharaga'
        ]);
        categories::create([
            'name_category' => 'Alat Elektronik',
            'description' => 'alat elektronik'
        ]);
        categories::create([
            'name_category' => 'Alat musik',
            'description' => 'alat musik dari ruang musik'
        ]);
        categories::create([
            'name_category' => 'Alat tulis',
            'description' => 'alat tulis'
        ]);
    }
}
