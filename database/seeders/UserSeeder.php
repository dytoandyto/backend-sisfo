<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dhanisss',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'created_at' => Carbon::parse('2025-06-07 10:00:00'),
            'updated_at' => Carbon::parse('2025-06-07 10:00:00'),
        ]);
        User::create([
            'name' => 'Andi',
            'email' => 'andi@gmail.com',
            'password' => bcrypt('andi123'),
            'created_at' => Carbon::parse('2025-06-07 10:00:00'),
            'updated_at' => Carbon::parse('2025-06-07 10:00:00'),
        ]);
        User::create([
            'name' => 'Budi',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('Budi123'),
            'created_at' => Carbon::parse('2025-06-07 10:00:00'),
            'updated_at' => Carbon::parse('2025-06-07 10:00:00'),
        ]);

    }
}
