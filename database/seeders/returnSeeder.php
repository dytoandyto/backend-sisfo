<?php

namespace Database\Seeders;

use App\Models\return_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class returnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        return_item::create([
            "id_loan"     =>   1,
            "id_user"     =>   1,
            "id_item"     =>   1,
            "return_date" => "2025-06-10",
            "date_returned" => "2025-06-11",
            "quantity"    =>  2,
            "notes"        => "Kondisi baik, dipinjam lama",
            "condition"   => "good",
            "created_at" => Carbon::parse('2025-06-07 10:00:00'),
            "updated_at" => Carbon::parse('2025-06-07 10:00:00'),
        ]);
    }
}
