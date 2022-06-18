<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Interface\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    public $defaultPassword = 'alhisan';

    // ------------- User ------------- //
    public function userAdmin()
    {
        return DB::table('users as u')
            ->join('profiles as p', 'p.user_id', '=', 'u.id')
            ->selectRaw('
            u.id, u.name, u.username, u.email
        ')
            ->orderBy('u.name');
    }

    public function aktifitasUser()
    {
        return DB::table('aktifitas_user as au')
            ->selectRaw('au.*')
            ->orderByDesc('au.created_at');
    }

    public function storeUser($request)
    {
        try {
            DB::beginTransaction();
            $attr = $request->all();
            $role = $attr['roles'];
            $attr['password'] = bcrypt($this->defaultPassword);
            $user = User::create($attr);

            $profile = Profile::create([
                'user_id' => $user->id,
            ]);

            $user->assignRole([$role]);

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.user.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function updateUser($user, $request)
    {
        try {
            DB::beginTransaction();

            $role = $request->roles;

            $user->update($request->all());
            $user->profile->update($request->all());
            if ($request->has('roles')) {
                $user->syncRoles([$role]);
            }

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.user.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function deleteUser($user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.user.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function profilSaya($userId)
    {
        return DB::table('users as u')
            ->join('profiles as p', 'p.user_id', '=', 'u.id')
            ->selectRaw('u.id, u.name, u.username, u.email, p.nik, p.tempat_lahir, p.tanggal_lahir, p.jenis_kelamin, p.foto, p.no_hp, p.alamat')
            ->where('u.id', $userId)
            ->where('p.user_id', $userId)
            ->first();
    }

    public function updateProfilUser($user, $request)
    {
        try {
            DB::beginTransaction();

            $user->update($request->all());
            $profil = Profile::where('user_id', $user->id)->first();
            $profil->nik = $request->nik;
            $profil->tempat_lahir = $request->tempat_lahir;
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->no_hp = $request->no_hp;
            $profil->alamat = $request->alamat;
            if ($request->hasFile('foto')) {
                $fotoOld = $profil->foto;
                if ($fotoOld)
                    Storage::delete('user/' . $fotoOld);
                $filename = uploadFile($request->file('foto'), 'user/');
                $profil->foto = $filename;
            }
            $profil->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.profil-saya', $user->username)
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }


    // ------------- Role ------------- //
    public function roleUsers()
    {
        return DB::table('roles as r')
            ->selectRaw('r.id, r.name, r.created_at')
            ->orderByDesc('r.created_at');
    }

    public function findRole($id)
    {
        return DB::table('roles')->selectRaw('*')->where('id', $id)->first();
    }

    public function storeRole($request)
    {
        try {
            DB::beginTransaction();
            DB::table('roles')->insert([
                'name' => Str::snake($request->name),
                'guard_name' => 'web',
                'created_at' => tanggalSekarang()
            ]);

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function updateRole($roleId, $request)
    {
        try {
            DB::beginTransaction();
            $role = DB::table('roles')->where('id', $roleId)->update([
                'name' => Str::snake($request->name),
                'updated_at' => tanggalJamSekarang(),
            ]);

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function deleteRole($roleId)
    {
        try {
            DB::beginTransaction();
            $role = DB::table('roles')->where('id', $roleId)->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    // ------------- Permission ------------- //
    public function permissionUsers()
    {
        return DB::table('permissions as p')
            ->selectRaw('p.id, p.name, p.created_at')
            ->orderByDesc('p.created_at');
    }

    public function findPermission($id)
    {
        return DB::table('permissions')->selectRaw('*')->where('id', $id)->first();
    }

    public function storePermission($request)
    {
        try {
            DB::beginTransaction();
            DB::table('permissions')->insert([
                'name' => Str::snake($request->name),
                'guard_name' => 'web',
                'created_at' => tanggalSekarang()
            ]);

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function updatePermission($permissionId, $request)
    {
        try {
            DB::beginTransaction();
            $permission = DB::table('permissions')->where('id', $permissionId)->update([
                'name' => Str::snake($request->name),
                'updated_at' => tanggalJamSekarang(),
            ]);

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function deletePermission($permissionId)
    {
        try {
            DB::beginTransaction();
            $permission = DB::table('permissions')->where('id', $permissionId)->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.role-permission.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }
}
