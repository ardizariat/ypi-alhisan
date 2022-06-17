<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Repositories\Interface\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function rolePermission(Request $request)
    {
        $data['title'] = 'Role Permission';

        if ($request->ajax()) {
            if ($request->has('role')) {
                $role = $request->get('role');
                $data['roles'] = $this->userRepository->roleUsers()
                    ->when(
                        $role ?? false,
                        fn ($query) =>
                        $query->where('r.name', 'like', '%' . $role . '%')
                    )
                    ->get();
                return view('admin.user.rolePermission.fetchRole', compact('data'))->render();
            }
            if ($request->has('permission')) {
                $permission = $request->get('permission');

                $data['permissions'] = $this->userRepository->permissionUsers()
                    ->when(
                        $permission ?? false,
                        fn ($query) =>
                        $query->where('p.name', 'like', '%' . $permission . '%')
                    )
                    ->get();
                return view('admin.user.rolePermission.fetchPermission', compact('data'))->render();
            }
        }

        $data['roles'] = $this->userRepository
            ->roleUsers()
            ->get();
        $data['permissions'] = $this->userRepository
            ->permissionUsers()
            ->get();

        return view('admin.user.rolePermission.index', compact('data'));
    }

    // ------------- Role ------------- //
    public function createRole()
    {
        $output = '
            <form action="' . route('admin.role-permission.store-role') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Role</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function storeRole(RoleRequest $request)
    {
        $req = $this->userRepository->storeRole($request);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }

    public function editRole($id)
    {
        $role = $this->userRepository->findRole($id);
        $output = '
            <form action="' . route('admin.role-permission.update-role', $id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Update Role</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="' . $role->name . '" class="form-control"
                                        name="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }


    public function updateRole($id, Request $request)
    {
        $req = $this->userRepository->updateRole($id, $request);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }

    public function deleteRole($id)
    {
        $req = $this->userRepository->deleteRole($id);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }

    // ------------- Permission ------------- //
    public function createPermission()
    {
        $output = '
            <form action="' . route('admin.role-permission.store-permission') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Permission</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Permission</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function editPermission($id)
    {
        $permission = $this->userRepository->findPermission($id);
        $output = '
            <form action="' . route('admin.role-permission.update-permission', $id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Update Permission</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Permission</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="' . $permission->name . '" class="form-control"
                                        name="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function storePermission(Request $request)
    {
        $req = $this->userRepository->storePermission($request);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }

    public function updatePermission($id, Request $request)
    {
        $req = $this->userRepository->updatePermission($id, $request);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }

    public function deletePermission($id, Request $request)
    {
        $req = $this->userRepository->deletePermission($id, $request);
        if ($req['status'] == 'success') {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        } else {
            return response()->json([
                'data' => $req
            ], $req['status_code']);
        }
    }
}
