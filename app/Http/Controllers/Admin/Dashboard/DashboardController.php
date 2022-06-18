<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['agenda'] = $this->dashboardRepository->agendaBulanIni();
        $data['saldoKas'] = $this->dashboardRepository->saldoKasBulanIni();
        $data['kasMasukKeluar'] = $this->dashboardRepository->kasMasukKeluarBulanIni();
        return view('admin.dashboard.index', compact('data'));
    }
}
