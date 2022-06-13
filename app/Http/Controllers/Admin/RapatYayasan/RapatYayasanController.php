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
        try {
            DB::beginTransaction();
            DB::table('rapat_yayasan')->insert([
                'kode' => kodeRapatYayasan(),
                'tanggal' => $request->tanggal,
                'bahasan' => $request->bahasan,
                'created_at' => tanggalJamSekarang()
            ]);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Schedule rapat yayasan berhasil dibuat',
                'url' => route('admin.rapat-yayasan.index')
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Schedule rapat yayasan gagal dibuat',
            ], 400);
        }
    }

    public function delete(RapatYayasan $rapatYayasan)
    {
        try {
            DB::beginTransaction();
            $rapatYayasan->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Schedule rapat yayasan berhasil dihapus',
                'url' => route('admin.rapat-yayasan.index')
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Schedule rapat yayasan gagal dihapus',
            ], 400);
        }
    }

    public function share(RapatYayasan $rapatYayasan)
    {
        $data = Share::page(route('admin.rapat-yayasan.absen-peserta', $rapatYayasan->id))
            ->whatsapp()
            ->getRawLinks();

        return redirect($data);
    }

    public function absenPeserta(RapatYayasan $rapatYayasan)
    {

        if (!Auth::check()) {
            return redirect(route('auth.login'));
        }

        try {
            DB::beginTransaction();

            $data['rapat_yayasan_id'] = $rapatYayasan->id;
            $data['user_id'] = Auth::id();

            $peserta = DB::table('peserta_rapat_yayasan as p')
                ->selectRaw('p.id, p.rapat_yayasan_id, p.user_id')
                ->where('user_id', Auth::id())
                ->where('rapat_yayasan_id', $rapatYayasan->id)
                ->first();

            if (!$peserta) {
                DB::table('peserta_rapat_yayasan')->insert([
                    'rapat_yayasan_id' => $rapatYayasan->id,
                    'user_id' => Auth::id(),
                    'created_at' => tanggalJamSekarang()
                ]);
            }

            DB::commit();

            return view('admin.rapatYayasan.absen')->with('message', 'Terima kasih atas kehadiran anda');
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500);
        }
    }
}
