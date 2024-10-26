<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'description' => 'TV Samsung',
            'price' => 50,
            'stock' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
