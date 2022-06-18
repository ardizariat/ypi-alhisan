<?php

namespace App\Http\Controllers\Admin\Galeri;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Repositories\Interface\GaleriInterface;
use Illuminate\Http\Request;

class PosterDakwahController extends Controller
{
    public $perPage = 16;

    protected $galeriRepository;

    public function __construct(GaleriInterface $galeriRepository)
    {
        $this->galeriRepository = $galeriRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Poster Dakwah';
        if ($request->ajax()) {
            $q = $request->get('q');
            $data['posterDakwah'] = $this->galeriRepository->posterDakwahAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('g.keterangan', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.galeri.posterDakwah.fetch', compact('data'))->render();
        }

        $data['posterDakwah'] = $this->galeriRepository->posterDakwahAdmin()
            ->paginate($this->perPage);

        return view('admin.galeri.posterDakwah.index', compact('data'));
    }

    public function show(Galeri $galeri)
    {
        $path = asset('storage/posterDakwah/' . $galeri->filename);
        $url = route('admin.poster-dakwah.delete', $galeri->id);
        $output = '
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">' . $galeri->keterangan . '</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"
                                src="' . $path . '">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button onclick="hapus(`' . $url . '`)" type="submit" class="btn btn-danger ml-1">
                        Hapus
                    </button>
            </div>
        ';

        echo $output;
    }

    public function create()
    {
        $output = '
        <form action="' . route('admin.poster-dakwah.store') . '" enctype="multipart/form-data">
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
                                <label class="form-label">File</label>
                                <div class="form-control-wrap">
                                    <input type="file" class="form-control"
                                        name="filename" id="filename" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
        $req = $this->galeriRepository->storePosterDakwah($request);
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

    public function delete(Galeri $galeri)
    {
        $req = $this->galeriRepository->deletePosterDakwah($galeri);
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
