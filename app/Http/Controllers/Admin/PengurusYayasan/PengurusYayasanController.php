<?php

namespace App\Http\Controllers\Admin\PengurusYayasan;

use App\Http\Controllers\Controller;
use App\Models\PengurusYayasan;
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

    public function strukturOrganisasi()
    {
        $data['title'] = 'Struktur Organisasi';
        return view('admin.pengurusYayasan.strukturOrganisasi.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengurus Yayasan';
        $data['bagian'] = parent::bagian();
        return view('admin.pengurusYayasan.create', compact('data'));
    }

    public function store(Request $request)
    {
        $req = $this->pengurusYayasanRepository->storePengurusYayasan($request);
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

    public function edit(PengurusYayasan $pengurusYayasan)
    {
        $data['title'] = 'Ubah Pengurus Yayasan';
        $data['bagian'] = parent::bagian();
        $data['data'] = $this->pengurusYayasanRepository->pengurusYayasanDetail($pengurusYayasan->id);
        return view('admin.pengurusYayasan.edit', compact('data'));
    }

    public function update(PengurusYayasan $pengurusYayasan, Request $request)
    {
        $req = $this->pengurusYayasanRepository->updatePengurusYayasan($pengurusYayasan, $request);
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

    public function show(PengurusYayasan $pengurusYayasan)
    {
        $data = $this->pengurusYayasanRepository->pengurusYayasanDetail($pengurusYayasan->id);
        $path = asset('storage/pengurusYayasan/' . $data->foto);
        $output = '
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                            <img class="img-fluid d-block w-10"
                                src="' . $path . '">
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td width="20%">Nama</td>
                                <td>:</td>
                                <td>' . $data->nama . '</td>
                            </tr>
                            <tr>
                                <td width="20%">Bagian</td>
                                <td>:</td>
                                <td>' . $data->bagian . '</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        ';

        echo $output;
    }

    public function delete(PengurusYayasan $pengurusYayasan)
    {
        $req = $this->pengurusYayasanRepository->deletePengurusYayasan($pengurusYayasan);
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
