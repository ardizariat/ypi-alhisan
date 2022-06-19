<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["poster dakwah", 'poster dakwah', 'poster dakwah', 'aktif'],
            ["inventaris", 'inventaris', 'inventaris', 'aktif'],
            ["Al-Qur'an", 'al-quran', 'artikel', 'aktif'],
            ["Al-Hadist", 'al-hadist', 'artikel', 'aktif'],
        ];
        foreach ($data as $item) {
            DB::table('kategori')->insert([
                'nama' => $item[0],
                'slug' => $item[1],
                'kategori' => $item[2],
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
