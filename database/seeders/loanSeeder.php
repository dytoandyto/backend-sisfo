<?php

namespace Database\Seeders;

use App\Models\loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class loanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        loan::create([
            'item_code' => '001',
            'item_name' => 'Sepatu',
            'item_brand' => 'Nike',
            'item_category' => 'Alat Olahraga',
            'quantity' => 10
        ]);
    }
}
