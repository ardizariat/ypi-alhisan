<?php

namespace App\Http\Controllers\Admin\PengurusYayasan;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\PengurusYayasanInterface;
use Illuminate\Http\Request;

class PengurusYayasanController extends Controller
{
    public $perPage = 10;

    protected $pengurusYayasanRepository;

    public function __construct(PengurusYayasanInterface $pengurusYayasanRepository)
    {
        $this->pengurusYayasanRepository = $pengurusYayasanRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Pengurus Yayasan';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['pengurusYayasan'] = $this->pengurusYayasanRepository->daftarPengurusYayasanAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('py.nama', 'like', '%' . $q . '%')
                        ->orWhere('b.nama', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.pengurusYayasan.fetch', compact('data'))->render();
        }

        $data['pengurusYayasan'] = $this->pengurusYayasanRepository
            ->daftarPengurusYayasanAdmin()
            ->paginate($this->perPage);

        return view('admin.pengurusYayasan.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengurus Yayasan';
        $data['bagian'] = parent::bagian();
        return view('admin.pengurusYayasan.create', compact('data'));
    }
}
