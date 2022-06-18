<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Repositories\Interface\{
    ArtikelInterface,
    GaleriInterface,
    KalimatHikmahInterface,
    PengurusYayasanInterface
};
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $artikelRepository,
        $pengurusYayasanRepository,
        $kalimatHikmahRepository,
        $galeriRepository;


    public function __construct(
        ArtikelInterface $artikelRepository,
        PengurusYayasanInterface $pengurusYayasanRepository,
        KalimatHikmahInterface $kalimatHikmahRepository,
        GaleriInterface $galeriRepository
    ) {
        $this->artikelRepository = $artikelRepository;
        $this->pengurusYayasanRepository = $pengurusYayasanRepository;
        $this->kalimatHikmahRepository = $kalimatHikmahRepository;
        $this->galeriRepository = $galeriRepository;
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
        $data['data'] = $this->pengurusYayasanRepository->strukturOrganisasi();
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

            $data['artikel'] = $this->artikelRepository->artikelApp()
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
            ->artikelApp()
            ->paginate($perPage);

        $data['artikelTerbaru'] = $this->artikelRepository
            ->artikelApp()->limit(5)->get();

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

    public function kalimatHikmah()
    {
        $data['title'] = 'Kalimat Hikmah';
        $data['data'] = $this->kalimatHikmahRepository->kalimatHikmah();
        return view('frontend.kalimatHikmah', compact('data'));
    }

    public function posterDakwah(Request $request)
    {
        $perPage = 16;
        $data['title'] = 'Poster Dakwah';
        if ($request->ajax()) {
            $data['data'] = $this->galeriRepository->posterDakwahApp()
                ->paginate($perPage);
            return view('frontend.posterDakwahFetch', compact('data'))->render();
        }
        $data['data'] = $this->galeriRepository->posterDakwahApp()
            ->paginate($perPage);
        return view('frontend.posterDakwah', compact('data'));
    }

    public function posterDakwahDetail(Galeri $galeri)
    {
        $path = asset('storage/posterDakwah/' . $galeri->filename);
        $output = '
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">' . $galeri->keterangan . '</h5>
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
            </div>
        ';

        echo $output;
    }
}
