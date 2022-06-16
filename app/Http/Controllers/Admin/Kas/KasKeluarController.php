<?php

namespace App\Http\Controllers\Admin\Kas;

use App\Exports\Kas\LaporanKasKeluarExport;
use App\Exports\KasMasuk\LaporanKasMasukExport;
use App\Http\Controllers\Controller;
use App\Models\KasKeluar;
use App\Repositories\Interface\KasKeluarInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;

class KasKeluarController extends Controller
{
    public $perPage = 10;

    protected $kasKeluarRepository;

    public function __construct(KasKeluarInterface $kasKeluarRepository)
    {
        $this->kasKeluarRepository = $kasKeluarRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Kas Keluar';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['kasKeluar'] = $this->kasKeluarRepository->kasKeluarAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('kk.untuk', 'like', '%' . $q . '%')
                        ->orWhere('kk.tanggal', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.kasKeluar.fetch', compact('data'))->render();
        }

        // Get kasMasuk
        $data['kasKeluar'] = $this->kasKeluarRepository
            ->kasKeluarAdmin()
            ->paginate($this->perPage);
        return view('admin.kasKeluar.index', compact('data'));
    }

    public function create()
    {
        $output = '
            <form action="' . route('admin.kas-keluar.store') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Kas Keluar</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Untuk</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="untuk" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control"
                                        name="tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Nominal</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control"
                                        name="nominal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control"
                                        name="keterangan" autocomplete="off"></textarea>
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

    public function edit(KasKeluar $kasKeluar)
    {
        $output = '
            <form action="' . route('admin.kas-keluar.update', $kasKeluar->id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Ubah Kas Keluar</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Untuk</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="untuk" value="' . $kasKeluar->untuk . '" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control"
                                     value="' . $kasKeluar->tanggal . '" name="tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Nominal</label>
                                <div class="form-control-wrap">
                                    <input value="' . $kasKeluar->nominal . '"  type="number" class="form-control"
                                        name="nominal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control"
                                        name="keterangan" autocomplete="off">' . $kasKeluar->keterangan . '</textarea>
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

    public function store(Request $request)
    {
        $req = $this->kasKeluarRepository->storeKasKeluar($request);
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

    public function update(KasKeluar $kasKeluar, Request $request)
    {
        $req = $this->kasKeluarRepository->updateKasKeluar($kasKeluar, $request);
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

    public function delete(KasKeluar $kasKeluar)
    {
        $req = $this->kasKeluarRepository->deleteKasKeluar($kasKeluar);
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

    public function modalEksporLaporan()
    {
        $output = '
            <form target="_blank" action="' . route('admin.kas-keluar.ekspor-laporan') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Ekspor Laporan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Dari</label>
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control"
                                        name="dari" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Sampai</label>
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control"
                                        name="sampai" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Jenis File</label>
                                <div class="form-control-wrap">
                                    <select name="jenis_file" class="form-control">
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
        $dari = Carbon::parse($request->dari)->startOfDay();
        $sampai = Carbon::parse($request->sampai)->endOfDay();
        $jenisFile = $request->jenis_file;

        $data['title'] = 'Laporan Kas Keluar';
        $data['dari'] = $request->dari;
        $data['sampai'] = $request->sampai;
        $data['data'] = $this->kasKeluarRepository->dataLaporanKasKeluar($dari, $sampai);

        if ($jenisFile === 'pdf') {
            return view('admin.kasKeluar.laporan.pdf', compact('data'));
        } else if ($jenisFile === 'excel') {
            return Excel::download(new LaporanKasKeluarExport($data), 'kas-keluar.xlsx');
        }
    }
}
