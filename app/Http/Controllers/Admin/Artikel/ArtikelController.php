<?php

namespace App\Http\Controllers\Admin\Artikel;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Http\Request;

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

            $data['artikel'] = $this->artikelRepository->artikel()
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
            ->artikel()
            ->paginate($this->perPage);

        // Get kategori
        $data['kategori'] = $this->artikelRepository->kategoriArtikel();
        return view('admin.artikel.index', compact('data'));
    }
}
