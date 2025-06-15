<?php

namespace Database\Seeders;

use App\Models\item_master;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        item_master::create([
            'item_code' => '001',
            'item_name' => 'Sepatu',
            'item_brand' => 'Nike',
            'item_category' => 1,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '002',
            'item_name' => 'Bola',
            'item_brand' => 'Adidas',
            'item_category' => 1,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '003',
            'item_name' => 'Gitar',
            'item_brand' => 'Fender',
            'item_category' => 3,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '004',
            'item_name' => 'Piano',
            'item_brand' => 'Yamaha',
            'item_category' => 4,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '005',
            'item_name' => 'Kes',
            'item_brand' => 'Yamaha',
            'item_category' => 4,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '006',
            'item_name' => 'Tabur',
            'item_brand' => 'Yamaha',
            'item_category' => 4,
            'quantity' => 10
        ]);
        item_master::create([
            'item_code' => '007',
            'item_name' => 'Spidol',
            'item_brand' => 'FaberCastle',
            'item_category' => 4,
            'quantity' => 20
        ]);
    }
}
