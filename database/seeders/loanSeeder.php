<?php

namespace Database\Seeders;

use App\Models\loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class loanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        loan::create([
            'id' => 1,
            'id_user' => 1,
            'id_item' => 1,
            'date_loan' => '2025-06-07',
            'date_return' => '2025-06-10',
            'quantity' => 2,
            'status' => 'approve',
            'created_at' => Carbon::parse('2025-06-07 10:00:00'),
            'updated_at' => Carbon::parse('2025-06-07 10:00:00'),
        ]);
        loan::create([
            'id' => 2,
            'id_user' => 2,
            'id_item' => 2,
            'date_loan' => '2025-06-07',
            'date_return' => '2025-06-10',
            'quantity' => 1,
            'created_at' => Carbon::parse('2025-06-07 10:00:00'),
            'updated_at' => Carbon::parse('2025-06-07 10:00:00'),
        ]);
    }
}
