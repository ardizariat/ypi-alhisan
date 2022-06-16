<?php

namespace App\Exports\Kas;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class LaporanKasMasukExport implements FromView, ShouldAutoSize
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.kasMasuk.laporan.excel', [
            'data' => $this->data
        ]);
    }
}
