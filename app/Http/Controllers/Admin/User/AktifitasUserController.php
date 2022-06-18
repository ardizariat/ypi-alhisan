<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserInterface;
use Illuminate\Http\Request;

class AktifitasUserController extends Controller
{
    protected $userRepository;

    public $perPage = 15;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Aktifitas User';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['aktifitasUser'] = $this->userRepository->aktifitasUser()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('au.nama', 'like', '%' . $q . '%')
                        ->orWhere('au.aktifitas', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.user.aktifitasUser.fetch', compact('data'))->render();
        }

        $data['aktifitasUser'] = $this->userRepository->aktifitasUser()
            ->paginate($this->perPage);
        return view('admin.user.aktifitasUser.index', compact('data'));
    }
}
