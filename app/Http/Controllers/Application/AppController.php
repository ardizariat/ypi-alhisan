<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{
    protected $artikelRepository;

    public function __construct(ArtikelInterface $artikelRepository)
    {
        $this->artikelRepository = $artikelRepository;
    }

    public function beranda(Request $request)
    {
        return view('frontend.beranda');
    }

    public function kontak()
    {
        $data['title'] = 'Kontak';
        return view('frontend.kontak', compact('data'));
    }

    public function strukturOrganisasi()
    {
        $data['title'] = 'Struktur Organisasi';
        $req = Http::get(prefixAPI() . '/pengurus-yayasan/struktur-organisasi');
        $ok = $req->ok();

        if (!$ok) return $data['data'] = null;

        $res = $req->json();
        $data['data'] = $res['data'];
        return view('frontend.strukturOrganisasi', compact('data'));
    }

    public function galeri()
    {
        $data['title'] = 'Galeri';
        return view('frontend.galeri', compact('data'));
    }

    public function tentangKami()
    {
        $data['title'] = 'Tentang Kami';
        return view('frontend.tentangKami', compact('data'));
    }

    public function visiMisi()
    {
        $data['title'] = 'Visi, Misi Dan Tujuan';
        return view('frontend.visiMisi', compact('data'));
    }

    public function artikel(Request $request)
    {
        $perPage = 5;
        $data['title'] = 'Artikel';

        if ($request->ajax()) {
            $q = $request->get('q');

            $data['artikel'] = $this->artikelRepository->artikel()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('a.judul', 'like', '%' . $q . '%')
                )
                ->paginate($perPage);
            return view('frontend.artikelFetch', compact('data'))->render();
        }

        // Get artikel
        $data['artikel'] = $this->artikelRepository
            ->artikel()
            ->paginate($perPage);

        $data['artikelTerbaru'] = $this->artikelRepository
            ->artikel()->limit(5)->get();

        // Get kategori
        $data['kategori'] = $this->artikelRepository->kategoriArtikel();

        return view('frontend.artikel', compact('data'));
    }


    public function artikelDetail(Artikel $artikel)
    {
        $data['title'] = $artikel->judul;
        $data['data'] = $this->artikelRepository->artikelDetail($artikel->slug);

        return view('frontend.artikelDetail', compact('data'));
    }
}
