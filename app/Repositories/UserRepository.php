<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Interface\UserInterface;
use Illuminate\Support\Facades\DB;
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

            $user->update($request);
            $user->profile->update($request);
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
