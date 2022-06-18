<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\{User, Profile};
use App\Repositories\Interface\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $data['data'] = $this->userRepository->userAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('u.name', 'like', '%' . $q . '%')
                        ->orWhere('u.email', 'like', '%' . $q . '%')
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

    public function update(User $user, UserRequest $request)
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

    public function delete(User $user)
    {
        $req = $this->userRepository->deleteUser($user);
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

    public function profil(User $user)
    {
        $data['title'] = 'Profil Saya';
        $data['data'] = $this->userRepository->profilSaya($user->id);
        return view('admin.user.user.profil', compact('data'));
    }

    public function editProfil(User $user)
    {
        $data['title'] = 'Ubah Profil Saya';
        $data['data'] = $this->userRepository->profilSaya($user->id);
        return view('admin.user.user.editProfil', compact('data'));
    }

    public function updateProfil(User $user, Request $request)
    {
        $req = $this->userRepository->updateProfilUser($user, $request);
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

    public function updatePassword(User $user, Request $request)
    {
        $attr = $request->all();
        $request->validate([
            'password_lama' =>
            [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Password lama salah!');
                    }
                },
            ],
            'password' => 'required|min:4|confirmed'
        ]);

        $cek_password = Hash::check($attr['password_lama'], $user->password);
        if ($cek_password) {
            if ($attr['password'] === $attr['password_confirmation']) {
                $user->update([
                    'password' => Hash::make($attr['password']),
                ]);

                $user->tokens()->delete();

                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return response()->json([
                    'message' => 'Ganti password berhasil diubah!, setelah ini anda akan logout silahkan login dengan password baru',
                    'url' => route('auth.login')
                ], 200);
            }
        } else {

            return response()->json([
                'message' => 'Ubah password gagal!'
            ], 400);
        }
    }
}
