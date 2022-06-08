<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengurusYayasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $users = [
            ['KH. Abdul Aziz Ridwa, Lc', 'abdul_aziz', 'abdul_aziz@mail.com', 1],
            ['H. Ahmad Zainudin, S.Sos, MA', 'ahmad_zainudin', 'ahmad_zainudin@mail.com', 1],
            ['H. Agus Slamet Santoso', 'agus_santoso', 'agus_santoso@mail.com', 1],
            ['Ir. Untung Budiono', 'untung_budiono', 'untung_budiono@mail.com', 2],
            ['H. Suparno', 'suparno', 'suparno@mail.com', 2],
            ['Dra. Ermi Medias, M.pd', 'ermi_medias', 'ermi_medias@mail.com', 2],
            ['Ucup Supriatin, S.Pd.I', 'ucup_supriatin', 'ucup_supriatin@mail.com', 3],
            ['Eko Wahyu Purnomo', 'eko_wahyu', 'eko_wahyu@mail.com', 4],
            ['Shafiyyuddin, A.Md', 'shafiyyuddin', 'shafiyyuddin@mail.com', 5],
            ['Restu Eka Firdaus, S.Si', 'restu_eka', 'restu_eka@mail.com', 6],
            ['Nurul Choirudin, A.Md', 'nurul', 'nurul@mail.com', 7],
            ["Ma'mun Rosyid Ringgit", 'anggit', 'anggit@mail.com', 7],
            ["Gumawang Amarullah Sakti", 'gum', 'gum@mail.com', 7],
            ["Ari Sukarno", 'ari', 'ari@mail.com', 8],
            ["Ardi Nor Dzariat", 'ardi', 'ardi@mail.com', 8],
            ["Ismadi", 'ismadi', 'ismadi@mail.com', 8],
            ["Bashtian Achmad", 'bastian', 'bastian@mail.com', 9],
            ["Abi Manyu Abdurrahman", 'manyu', 'manyu@mail.com', 9],
        ];

        $bagian = [
            ['dewan pembina'],
            ['dewan pengawas'],
            ['ketua'],
            ['wakil'],
            ['sekretaris'],
            ['bendahara'],
            ['bidang pendidikan dan dakwah'],
            ['bidang sosial'],
            ['bidang usaha lainnya'],
        ];

        foreach ($bagian as $item) {

            $bagian = DB::table('bagian')->insertGetId([
                'nama' => $item[0],
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }

        foreach ($users as $user) {
            $userCreate = DB::table('users')->insertGetId([
                'name' => $user[0],
                'username' => $user[1],
                'email' => $user[2],
                'password' => bcrypt('admin'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);

            $userNew = DB::table('users')->select('id', 'name')->whereId($userCreate)->first();

            $pengurusYayasan = DB::table('pengurus_yayasan')->insertGetId([
                'nama' => $userNew->name,
                'user_id' => $userNew->id,
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);

            $strukturOrganisasi = DB::table('struktur_organisasi')->insertGetId([
                'pengurus_yayasan_id' => $pengurusYayasan,
                'bagian_id' => $user[3],
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }
    }
