<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\{User, Profile};
use App\Repositories\Interface\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userRepository;

    public $perPage = 15;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'User';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['user'] = $this->userRepository->userAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('u.name', 'like', '%' . $q . '%')
                        ->orWhere('u.email', 'like', '%' . $q . '%')
                        ->orWhere('r.name', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            $data['user'] = $this->with($data['data']);
            return view('admin.user.user.fetch', compact('data'))->render();
        }

        $data['data'] = $this->userRepository->userAdmin()
            ->paginate($this->perPage);
        $data['user'] = $this->with($data['data']);
        return view('admin.user.user.index', compact('data'));
    }

    public function with($data)
    {
        foreach ($data as $user) {
            $user->role =  DB::table('model_has_roles as mhr')
                ->selectRaw('   
                r.name
            ')
                ->join('roles as r', 'r.id', '=', 'mhr.role_id')
                ->where('mhr.model_id', $user->id)
                ->get();
        }
        return $data;
    }

    public function create()
    {
        $data['title'] = 'Tambah User';
        $data['roles'] = parent::roles();
        return view('admin.user.user.create', compact('data'));
    }

    public function store(UserRequest $request)
    {
        $req = $this->userRepository->storeUser($request);
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

    public function edit(User $user)
    {
        $data['title'] = 'Ubah User';
        $data['roles'] = parent::roles();
        $data['data'] = $user;
        return view('admin.user.user.edit', compact('data'));
    }

    public function update(UserRequest $request, User $user)
    {
        $req = $this->userRepository->updateUser($user, $request);
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
