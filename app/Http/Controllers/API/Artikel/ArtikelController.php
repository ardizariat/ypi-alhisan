<?php

namespace App\Http\Controllers\API\Artikel;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public $perPage = 5;

    protected $artikelRepository;

    public function __construct(ArtikelInterface $artikelRepository)
    {
        $this->artikelRepository = $artikelRepository;
    }

    public function artikel(Request $request)
    {
        $params = [
            'kategori' => $request->query('kategori'),
            'search' => $request->query('search'),
            'perPage' => $request->query('per_page') ?? 5
        ];

        $data = $this->artikelRepository
            ->artikelApp($params)
            ->paginate($params['perPage'])
            ->withQueryString();

        return ResponseFormatter::success($data, 'Get data artikel berhasil');
    }

    public function artikelDetail(Artikel $artikel)
    {
        $data = $this->artikelRepository
            ->artikelDetail($artikel->slug);
        return ResponseFormatter::success($data, 'Get detail artikel berhasil');
    }

    public function kategori(Request $request)
    {
        $data = $this->artikelRepository->kategoriArtikel($request->searchKategori);
        return ResponseFormatter::success($data, 'Get kategori artikel berhasil');
    }
}
