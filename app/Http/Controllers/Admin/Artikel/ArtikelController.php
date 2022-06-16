<?php

namespace App\Http\Controllers\Admin\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArtikelRequest;
use App\Models\Artikel;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Share;

class ArtikelController extends Controller
{
    public $perPage = 10;

    protected $artikelRepository;

    public function __construct(ArtikelInterface $artikelRepository)
    {
        $this->artikelRepository = $artikelRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Artikel';
        if ($request->ajax()) {
            $q = $request->get('q');

            $data['artikel'] = $this->artikelRepository->artikelAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('a.judul', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.artikel.fetch', compact('data'))->render();
        }

        // Get artikel
        $data['artikel'] = $this->artikelRepository
            ->artikelAdmin()
            ->paginate($this->perPage);
        return view('admin.artikel.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah Artikel';
        $data['kategori'] = $this->artikelRepository->kategoriArtikel();
        $data['status'] = parent::statusArtikel();
        return view('admin.artikel.create', compact('data'));
    }

    public function store(ArtikelRequest $request)
    {
        $req = $this->artikelRepository->storeArtikel($request);
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

    public function show(Artikel $artikel)
    {
        $data['title'] = $artikel->judul;
        $data['data'] = $this->artikelRepository->artikelDetail($artikel->slug);

        return view('frontend.artikelDetail', compact('data'));
    }

    public function edit(Artikel $artikel)
    {
        $data['title'] = 'Ubah data';
        $data['data'] = $this->artikelRepository->artikelDetail($artikel->slug);
        $data['kategori'] = $this->artikelRepository->kategoriArtikel();
        $data['status'] = parent::statusArtikel();
        return view('admin.artikel.edit', compact('data'));
    }

    public function update(Artikel $artikel, ArtikelRequest $request)
    {
        $req = $this->artikelRepository->updateArtikel($artikel, $request);
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

    public function share(Artikel $artikel)
    {
        $data = Share::page(route('artikel-detail', $artikel->slug))
            ->whatsapp()
            ->getRawLinks();

        return redirect($data);
    }

    public function delete(Artikel $artikel)
    {
        $req = $this->artikelRepository->deleteArtikel($artikel);
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
