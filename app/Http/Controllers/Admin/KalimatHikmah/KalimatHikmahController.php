<?php

namespace App\Http\Controllers\Admin\KalimatHikmah;

use App\Http\Controllers\Controller;
use App\Models\KalimatHikmah;
use App\Repositories\Interface\KalimatHikmahInterface;
use Illuminate\Http\Request;

class KalimatHikmahController extends Controller
{
    public $perPage = 10;

    protected $kalimatHikmahRepository;

    public function __construct(KalimatHikmahInterface $kalimatHikmahRepository)
    {
        $this->kalimatHikmahRepository = $kalimatHikmahRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Kalimat Hikmah';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['kalimatHikmah'] = $this->kalimatHikmahRepository->kalimatHikmahAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('k.penulis', 'like', '%' . $q . '%')
                        ->orWhere('k.text', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.kalimatHikmah.fetch', compact('data'))->render();
        }

        // Get kalimatHikmah
        $data['kalimatHikmah'] = $this->kalimatHikmahRepository
            ->kalimatHikmahAdmin()
            ->paginate($this->perPage);
        return view('admin.kalimatHikmah.index', compact('data'));
    }

    public function modalCreate()
    {
        $output = '
            <form action="' . route('admin.kalimat-hikmah.store') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Penulis</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="penulis" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group with-title mb-3">
                                <textarea name="text" autocomplete="off" class="form-control" rows="5"></textarea>
                                <label>Kalimat Hikmah</label>
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
        $req = $this->kalimatHikmahRepository->storeKalimatHikmah($request);
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

    public function edit(KalimatHikmah $kalimatHikmah)
    {
        $output = '
            <form action="' . route('admin.kalimat-hikmah.update', $kalimatHikmah->id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Form</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Penulis</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"
                                        name="penulis" value="' . $kalimatHikmah->penulis . '" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group with-title mb-3">
                                <textarea name="text" autocomplete="off" class="form-control" rows="5">' . $kalimatHikmah->text . '</textarea>
                                <label>Kalimat Hikmah</label>
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

    public function update(KalimatHikmah $kalimatHikmah, Request $request)
    {
        $req = $this->kalimatHikmahRepository->updateKalimatHikmah($kalimatHikmah, $request);
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

    public function delete(KalimatHikmah $kalimatHikmah)
    {
        $req = $this->kalimatHikmahRepository->deleteKalimatHikmah($kalimatHikmah);
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
