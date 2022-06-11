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
        // Get artikel
        $resArtikel['data'] = $this->artikelRepository
            ->artikel()
            ->paginate(3);

        // Get kategori
        $reqKategori = Http::get(prefixAPI() . '/artikel/kategori');
        $ok = $reqKategori->ok();
        if (!$ok) return $data['kategori'] = null;
        $resKategori = $reqKategori->json();

        $data['artikel'] = $resArtikel['data'];
        $data['kategori'] = $resKategori['data'];

        return view('frontend.beranda', compact('data'));
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
        $data['title'] = 'Artikel';

        // Get artikel
        $resArtikel['data'] = $this->artikelRepository
            ->artikel()
            ->paginate(3);

        // Get kategori
        $reqKategori = Http::get(prefixAPI() . '/artikel/kategori');
        $ok = $reqKategori->ok();
        if (!$ok) return $data['kategori'] = null;
        $resKategori = $reqKategori->json();

        $data['artikel'] = $resArtikel['data'];
        $data['kategori'] = $resKategori['data'];
        return view('frontend.artikel', compact('data'));
    }


    public function artikelDetail(Artikel $artikel)
    {
        $data['title'] = $artikel->judul;
        $req = Http::get(prefixAPI() . "/artikel/{$artikel->slug}");
        $ok = $req->ok();

        if (!$ok) return $data['data'] = null;

        $res = $req->json();
        $data['data'] = $res['data'];

        return view('frontend.artikelDetail', compact('data'));
    }
}
