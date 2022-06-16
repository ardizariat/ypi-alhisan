<?php

namespace App\Http\Controllers\Admin\KasMasuk;

use App\Http\Controllers\Controller;
use App\Models\KasMasuk;
use App\Repositories\Interface\KasMasukInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasMasukController extends Controller
{
    public $perPage = 10;

    protected $kasMasukRepository;

    public function __construct(KasMasukInterface $kasMasukRepository)
    {
        $this->kasMasukRepository = $kasMasukRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Kas Masuk';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['kasMasuk'] = $this->kasMasukRepository->kasMasukAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('km.dari', 'like', '%' . $q . '%')
                        ->orWhere('km.tanggal', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.kasMasuk.fetch', compact('data'))->render();
        }

        // Get kasMasuk
        $data['kasMasuk'] = $this->kasMasukRepository
            ->kasMasukAdmin()
            ->paginate($this->perPage);
        return view('admin.kasMasuk.index', compact('data'));
    }

    public function create()
    {
        $output = '
            <form action="' . route('admin.kas-masuk.store') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Kas Masuk</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Dari</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="dari" autocomplete="off">
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

    public function edit(KasMasuk $kasMasuk)
    {
        $output = '
            <form action="' . route('admin.kas-masuk.update', $kasMasuk->id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form Ubah Kas Masuk</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Dari</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="dari" value="' . $kasMasuk->dari . '" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control"
                                     value="' . $kasMasuk->tanggal . '" name="tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Nominal</label>
                                <div class="form-control-wrap">
                                    <input value="' . $kasMasuk->nominal . '"  type="number" class="form-control"
                                        name="nominal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control"
                                        name="keterangan" autocomplete="off">' . $kasMasuk->keterangan . '</textarea>
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
        $req = $this->kasMasukRepository->storeKasMasuk($request);
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

    public function update(KasMasuk $kasMasuk, Request $request)
    {
        $req = $this->kasMasukRepository->updateKasMasuk($kasMasuk, $request);
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

    public function delete(KasMasuk $kasMasuk)
    {
        $req = $this->kasMasukRepository->deleteKasMasuk($kasMasuk);
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
            <form target="_blank" method="post" action="' . route('admin.kas-masuk.ekspor-laporan') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Ekspor Laporan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                <input name="_token" value="' . csrf_token() . '" type="hidden">
                    <input name="_method" type="hidden" value="post">
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
                                    <select name="jenis" class="form-control">
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

        $data = KasMasuk::whereBetween('tanggal', [$dari, $sampai])->get();
        return $data;
    }
}
