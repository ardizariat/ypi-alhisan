<?php

namespace App\Http\Controllers\API\StrukturOrganisasi;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PengurusYayasanInterface;
use Illuminate\Http\Request;

class PengurusYayasanController extends Controller
{
    public $perPage = 10;

    protected $pengurusYayasanRepository;

    public function __construct(PengurusYayasanInterface $pengurusYayasanRepository)
    {
        $this->pengurusYayasanRepository = $pengurusYayasanRepository;
    }

    public function pengurusYayasan(Request $request)
    {
        $data = $this->pengurusYayasanRepository->daftarPengurusYayasan($request->get('search'));

        return ResponseFormatter::success($data, 'get data pengurus yayasan sukses');
    }

    public function strukturOrganisasi(Request $request)
    {
        $data = $this->pengurusYayasanRepository->strukturOrganisasi($request->get('search'));

        return ResponseFormatter::success($data, 'get data struktur organisasi sukses');
    }
}
