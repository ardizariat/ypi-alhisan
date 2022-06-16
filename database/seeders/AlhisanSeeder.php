<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlhisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alhisan')->insert([
            'nama' => 'alhisan',
            'email' => 'alhisan@mail.com',
            'no_telpon' => '021 46739129',
            'no_hp' => '0857 8292 1289',
            'visi' => 'Menjadi lembaga dakwah dan pendidikan islam terbaik dalam
                        mencerahkan dan mencerdaskan kehidupan umat guna mewujudkan
                        generasi istimewa yang beriman, berilmu dan bertaqwa.',
            'misi' => "<ol>
                            <li>
                                Mewujudkan program-program tarbiyah islamiyah yang komperhensif
                                meliputi semua prinsip-prinsip agama islam, baik aqidah, ibadah,
                                mu'amalah, akhlaq dan adab.
                            </li>
                            <li>
                                Menjadi wadah sebagai media dakwah, sosial dan pendidikan untuk
                                melaksanakan prinsip-prinsip ajaran islam yang berlandaskan
                                Al-Qur'an dan Al-Hadist dalam kehidupan.
                            </li>
                            <li>
                                Membina dan memajukan masyarakat melalui pengembangan kegiatan
                                yang meningkatkan IMTAQ dan IPTEK sesuai dengan ajaran islam
                                untuk mewujudkan masyarakat yang beriman, berilmu dan bertaqwa.
                            </li>
                            <li>
                                Mendorong terwujudnya masyarakat yang sejahtera dan menjaga
                                ukhuwah serta kesatuan umat</li>
                        </ol>",
            'tujuan' => 'Mencetak generasi istimewa yang berkarakter dan menjadi pionir dalam membangun masyarakat yang beriman, berilmu dan kesejahteraan umat.',
            'alamat' => "Jl. Harapan Baru Timur Blok Ga 1 No.82,
                        RT.003/RW.007, Kota Baru, 
                        Bekasi Barat, Kota Bekasi,
                        Jawa Barat 17133",
            'created_at' => now()->toDateTimeString()
        ]);
    }
}
