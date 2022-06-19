<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PengurusYayasanSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['KH. Abdul Aziz Ridwan, Lc', 'abdul', 'abdul_aziz@mail.com', 1],
            ['H. Ahmad Zainudin, S.Sos, MA', 'ahmad', 'ahmad_zainudin@mail.com', 1],
            ['H. Agus Slamet Santoso', 'agus', 'agus_santoso@mail.com', 1],
            ['Ir. Untung Budiono', 'untung', 'untung_budiono@mail.com', 2],
            ['H. Suparno', 'suparno', 'suparno@mail.com', 2],
            ['Dra. Ermi Medias, M.pd', 'ermi', 'ermi_medias@mail.com', 2],
            ['Ucup Supriatin, S.Pd.I', 'ucup', 'ucup_supriatin@mail.com', 3],
            ['Eko Wahyu Purnomo', 'ekou', 'eko_wahyu@mail.com', 4],
            ['Shafiyyuddin, A.Md', 'shafiyyuddin', 'shafiyyuddin@mail.com', 5],
            ['Restu Eka Firdaus, S.Si', 'restu', 'restu_eka@mail.com', 6],
            ['Nurul Choirudin, A.Md', 'nurul', 'nurul@mail.com', 7],
            ["Ma'mun Rosyid Ringgit", "ma'mun", 'anggit@mail.com', 7],
            ["Gumawang Amarullah Sakti", 'gumawang', 'gum@mail.com', 7],
            ["Ari Sukarno", 'ari', 'ari@mail.com', 8],
            ["Ardi Nor Dzariat", 'ardi', 'ardi@mail.com', 8],
            ["Ismadi", 'ismadi', 'ismadi@mail.com', 8],
            ["Bashtian Achmad", 'bastian', 'bastian@mail.com', 9],
            ["Abi Manyu Abdurrahman", 'abi', 'manyu@mail.com', 9],
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

        foreach ($users as $item) {
            $userId = DB::table('users')->insertGetId([
                'name' => $item[0],
                'username' => $item[1],
                'email' => $item[2],
                'password' => bcrypt('alhisan'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);

            $profile = DB::table('profiles')->insertGetId([
                'user_id' => $userId
            ]);

            $user = User::findOrFail($userId);
            $role = 'admin';
            $permission = ['create', 'read', 'update', 'delete'];
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(2);
            $role->givePermissionTo([$permission]);

            $userNew = DB::table('users')->select('id', 'name')->whereId($userId)->first();

            $pengurusYayasan = DB::table('pengurus_yayasan')->insertGetId([
                'nama' => $userNew->name,
                'user_id' => $userId,
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);

            $strukturOrganisasi = DB::table('struktur_organisasi')->insertGetId([
                'pengurus_yayasan_id' => $pengurusYayasan,
                'bagian_id' => $item[3],
                'status' => 'aktif',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }
    }
}
