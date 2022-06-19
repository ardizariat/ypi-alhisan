<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Repositories\Interface\KategoriInterface;
use Illuminate\Http\Request;

class KategoriInventarisController extends Controller
{
    public $perPage = 16,
        $inventaris = 'inventaris';

    protected $kategoriRepository;

    public function __construct(KategoriInterface $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Kategori Inventaris';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['kategoriInventaris'] = $this->kategoriRepository
                ->kategoriAdmin($this->inventaris)
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('k.nama', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.kategori.inventaris.fetch', compact('data'))->render();
        }

        $data['kategoriInventaris'] = $this->kategoriRepository
            ->kategoriAdmin($this->inventaris)
            ->paginate($this->perPage);

        return view('admin.kategori.inventaris.index', compact('data'));
    }


    public function create()
    {
        $output = '
            <form action="' . route('admin.kategori-inventaris.store') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Kategori</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="nama" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function store(Request $request)
    {
        $url = route('admin.kategori-inventaris.index');
        $kategori = 'inventaris';
        $req = $this->kategoriRepository->storeKategori($request, $kategori, $url);
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

    public function edit(Kategori $kategori)
    {
        $output = '
            <form action="' . route('admin.kategori-inventaris.update', $kategori->id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Kategori</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Kategori</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="' . $kategori->nama . '" class="form-control"
                                        name="nama" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function update(Kategori $kategori, Request $request)
    {
        $url = route('admin.kategori-inventaris.index');
        $req = $this->kategoriRepository
            ->updateKategori($kategori, $request, $url);
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
