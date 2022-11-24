<?php

namespace App\Http\Controllers\Admin\RapatYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RapatYayasanRequest;
use App\Models\RapatYayasan;
use App\Models\User;
use App\Repositories\Interface\RapatYayasanInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Share;

class RapatYayasanController extends Controller
{
    public $perPage = 10;

    protected $rapatYayasanRepository;

    public function __construct(RapatYayasanInterface $rapatYayasanRepository)
    {
        $this->rapatYayasanRepository = $rapatYayasanRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Rapat Yayasan';
        // base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate());
        if ($request->ajax()) {
            $q = $request->get('q');

            $data['rapatYayasan'] = $this->rapatYayasanRepository->rapat()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('ry.bahasan', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.rapatYayasan.fetch', compact('data'))->render();
        }
        $data['rapatYayasan'] = $this->rapatYayasanRepository->rapat()
            ->paginate($this->perPage);

        return view('admin.rapatYayasan.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah Agenda Rapat Yayasan';
        $data['kode'] = kodeRapatYayasan();
        return view('admin.rapatYayasan.create', compact('data'));
    }

    public function store(RapatYayasanRequest $request)
    {
        $req = $this->rapatYayasanRepository->storeRapatYayasan($request);
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

    public function edit(RapatYayasan $rapatYayasan)
    {
        $data['title'] = 'Ubah Agenda Rapat Yayasan';
        $data['data'] = $rapatYayasan;
        return view('admin.rapatYayasan.edit', compact('data'));
    }

    public function update(RapatYayasan $rapatYayasan, RapatYayasanRequest $request)
    {
        $req = $this->rapatYayasanRepository->updateRapatYayasan($rapatYayasan, $request);
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

    public function delete(RapatYayasan $rapatYayasan)
    {
        $req = $this->rapatYayasanRepository->deleteRapatYayasan($rapatYayasan);
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

    public function share(RapatYayasan $rapatYayasan)
    {
        $url = route('admin.rapat-yayasan.absen-peserta', $rapatYayasan->id);
        $message = "Silahkan klik link untuk melakukan absensi " . $url . "";
        $data = Share::page($message)
            ->whatsapp()
            ->getRawLinks();

        return redirect($data);
    }

    public function absenPeserta(RapatYayasan $rapatYayasan)
    {

        if (!Auth::check()) {
            return redirect(route('auth.login'));
        }

        return view('admin.rapatYayasan.absen', compact('rapatYayasan'));
    }

    public function absen(RapatYayasan $rapatYayasan, Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Anda belum login'
            ], 400);
        }

        try {
            DB::beginTransaction();

            $data['rapat_yayasan_id'] = $rapatYayasan->id;
            $data['user_id'] = Auth::id();
            $kode = $request->kode;

            $peserta = DB::table('peserta_rapat_yayasan as p')
                ->selectRaw('p.id, p.rapat_yayasan_id, p.user_id')
                ->where('p.user_id', Auth::id())
                ->where('p.rapat_yayasan_id', $rapatYayasan->id)
                ->first();

            if ($rapatYayasan->kode !== $kode) {
                return response()->json([
                    'message' => 'Kode rapat salah'
                ], 400);
            }

            if (!$peserta) {
                DB::table('peserta_rapat_yayasan')->insert([
                    'rapat_yayasan_id' => $rapatYayasan->id,
                    'user_id' => Auth::id(),
                    'created_at' => tanggalJamSekarang()
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Absen berhasil, terima kasih atas kehadirannya',
                'url' => route('admin.dashboard.index')
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function show(RapatYayasan $rapatYayasan)
    {
        $data['title'] = 'Hasil Rapat Yayasan';
        $data['peserta'] = $this->rapatYayasanRepository->peserta($rapatYayasan->id);
        $data['rapatYayasan'] = $rapatYayasan;

        return view('admin.rapatYayasan.show', compact('data'));
    }

    public function print(RapatYayasan $rapatYayasan)
    {
        $data['title'] = 'Hasil Rapat Yayasan';
        $data['peserta'] = $this->rapatYayasanRepository->peserta($rapatYayasan->id);
        $data['rapatYayasan'] = $rapatYayasan;

        return view('admin.rapatYayasan.print', compact('data'));
    }
}
