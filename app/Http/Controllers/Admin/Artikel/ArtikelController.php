<?php

namespace App\Http\Controllers\Admin\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->judul);
            $artikelSlug = Artikel::where('slug', $slug)->first();
            if ($artikelSlug)
                $slug = $slug . rand(1, 10);
            $artikel = new Artikel();
            $artikel->judul = Str::title($request->judul);
            $artikel->slug = $slug;
            $artikel->kategori_id = $request->kategori_id;
            $artikel->user_id = auth()->id();
            $artikel->konten = $request->konten;
            $artikel->status = $request->status ?? 'draft';
            $artikel->dipublikasi = $request->status == 'dipublikasi' ? tanggalSekarang() : null;
            if ($request->hasFile('thumbnail')) {
                $filename = uploadFile($request->file('thumbnail'), 'artikel/');
                $artikel->thumbnail = $filename;
            }
            $artikel->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Artikel berhasil dibuat',
                'url' => route('admin.artikel.index')
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
