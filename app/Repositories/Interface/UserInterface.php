<?php

namespace App\Repositories\Interface;

interface UserInterface
{
    public function userAdmin();
    public function storeUser($request);
    public function updateUser($user, $request);
    public function deleteUser($user);

    public function roleUsers();
    public function findRole($id);
    public function storeRole($request);
    public function updateRole($roleId, $request);
    public function deleteRole($roleId);

    public function permissionUsers();
    public function findPermission($id);
    public function storePermission($request);
    public function updatePermission($permissionId, $request);
    public function deletePermission($permissionId);
}
