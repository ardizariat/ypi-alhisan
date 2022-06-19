<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Exports\Inventaris\LaporanBarangInventarisExport;
use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Repositories\Interface\InventarisInterface;
use DB;
use Excel;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public $perPage = 10;

    protected $inventarisRepository;

    public function __construct(InventarisInterface $inventarisRepository)
    {
        $this->inventarisRepository = $inventarisRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Inventaris';
        if ($request->ajax()) {
            $q = $request->get('q');

            $data['inventaris'] = $this->inventarisRepository->inventarisAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('i.nama', 'like', '%' . $q . '%')
                        ->orWhere('i.kode', 'like', '%' . $q . '%')
                        ->orWhere('i.keadaan', 'like', '%' . $q . '%')
                        ->orWhere('i.tahun_pembelian', 'like', '%' . $q . '%')
                        ->orWhere('k.nama', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.inventaris.fetch', compact('data'))->render();
        }
        $data['inventaris'] = $this->inventarisRepository->inventarisAdmin()
            ->paginate($this->perPage);

        return view('admin.inventaris.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah Inventaris';
        $data['kategori'] = $this->inventarisRepository->kategoriInventaris();
        $data['status'] = parent::statusInventaris();
        return view('admin.inventaris.create', compact('data'));
    }

    public function show(Inventaris $inventaris)
    {
        $data['title'] = 'Detail Barang Inventaris';
        $data['data'] = $this->inventarisRepository->detailInventarisAdmin($inventaris->id);
        return view('admin.inventaris.show', compact('data'));
    }

    public function store(Request $request)
    {
        $req = $this->inventarisRepository->storeInventaris($request);
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

    public function edit(Inventaris $inventaris)
    {
        $data['title'] = 'Ubah Barang Inventaris';
        $data['kategori'] = $this->inventarisRepository->kategoriInventaris();
        $data['status'] = parent::statusInventaris();
        $data['data'] = $this->inventarisRepository->detailInventarisAdmin($inventaris->id);
        return view('admin.inventaris.edit', compact('data'));
    }

    public function update(Inventaris $inventaris, Request $request)
    {
        $req = $this->inventarisRepository->updateInventaris($inventaris, $request);
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

    public function delete(Inventaris $inventaris, Request $request)
    {
        $req = $this->inventarisRepository->deleteInventaris($inventaris, $request);
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

    public function modalEkspor()
    {
        $output = '
            <form target="_blank" action="' . route('admin.inventaris.ekspor-laporan') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Ekspor Laporan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Jenis File</label>
                                <div class="form-control-wrap">
                                    <select name="jenis_file" class="form-select form-control">
                                        <option value="" disabled selected>Pilih Tipe File</option>
                                        <option value="pdf">PDF</option>
                                        <option value="excel">EXCEL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        Ekspor
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function eksporLaporan(Request $request)
    {
        $jenisFile = $request->jenis_file;

        $data['title'] = 'Data Inventaris';
        $data['data'] = $this->inventarisRepository->eksporDataInventaris();
        $subtotal = 0;
        foreach ($data['data'] as $barang) {
            $subtotal += $barang->harga_beli_satuan * $barang->jumlah;
        }
        $data['total'] = $subtotal;
        if ($jenisFile === 'pdf') {
            return view('admin.inventaris.laporan.pdf', compact('data'));
        } else if ($jenisFile === 'excel') {
            return Excel::download(new LaporanBarangInventarisExport($data), 'inventaris.xlsx');
        }
    }
}
