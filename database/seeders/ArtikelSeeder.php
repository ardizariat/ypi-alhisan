<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {
            DB::table('artikel')->insert([
                'kategori_id' => rand(1, 6),
                'user_id' => rand(1, 18),
                'slug' => Str::slug($faker->sentence(3)),
                'judul' => $i . Str::title($faker->sentence()),
                'konten' => $faker->paragraph(50),
                'dipublikasi' => now()->toDateString(),
                'status' => 'dipublikasi',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
