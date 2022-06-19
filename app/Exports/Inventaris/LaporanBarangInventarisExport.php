<?php

namespace App\Exports\Inventaris;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class LaporanBarangInventarisExport implements FromView, ShouldAutoSize
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.inventaris.laporan.excel', [
            'data' => $this->data
        ]);
    }
}
