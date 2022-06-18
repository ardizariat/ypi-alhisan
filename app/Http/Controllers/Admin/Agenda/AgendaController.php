<?php

namespace App\Http\Controllers\Admin\Agenda;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Repositories\Interface\AgendaInterface;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public $perPage = 10;

    protected $agendaRepository;

    public function __construct(AgendaInterface $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Agenda Yayasan';
        if ($request->ajax()) {
            $q = $request->get('q');

            $data['agenda'] = $this->agendaRepository->agendaAdmin()
                ->when(
                    $q ?? false,
                    fn ($query) =>
                    $query->where('a.keterangan', 'like', '%' . $q . '%')
                )
                ->paginate($this->perPage);
            return view('admin.agenda.fetch', compact('data'))->render();
        }
        $data['agenda'] = $this->agendaRepository->agendaAdmin()
            ->paginate($this->perPage);

        return view('admin.agenda.index', compact('data'));
    }

    public function create()
    {
        $output = '
            <form action="' . route('admin.agenda.store') . '">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Agenda</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="form-control-wrap">
                                    <input type="datetime-local" class="max-date form-control"
                                        name="tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group with-title mb-3">
                                <textarea name="keterangan" autocomplete="off" class="form-control" rows="5"></textarea>
                                <label>Agenda</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function store(Request $request)
    {
        $req = $this->agendaRepository->storeAgenda($request);
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

    public function edit(Agenda $agenda)
    {
        $output = '
            <form action="' . route('admin.agenda.update', $agenda->id) . '">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Agenda</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_method" type="hidden" value="put">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="form-control-wrap">
                                    <input type="datetime-local" value="' . $agenda->tanggal . '" class="max-date form-control"
                                        name="tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group with-title mb-3">
                                <textarea name="keterangan" autocomplete="off" class="form-control" rows="5">' . $agenda->keterangan . '</textarea>
                                <label>Agenda</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button onclick="save(this.form)" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </form>
        ';
        echo $output;
    }

    public function update(Agenda $agenda, Request $request)
    {
        $req = $this->agendaRepository->updateAgenda($agenda, $request);
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

    public function delete(Agenda $agenda)
    {
        $req = $this->agendaRepository->deleteAgenda($agenda);
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
