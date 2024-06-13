<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data example for seeding
        $barangs = [
            [
                'category_id' => 1,
                'nama_barang' => 'Laptop Dell XPS 13',
                'stok' => 10,
                'image' => 'dell_xps_13.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'nama_barang' => 'MacBook Pro',
                'stok' => 5,
                'image' => 'macbook_pro.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'nama_barang' => 'HP Spectre x360',
                'stok' => 8,
                'image' => 'hp_spectre_x360.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the table
        DB::table('barangs')->insert($barangs);
    }
}
