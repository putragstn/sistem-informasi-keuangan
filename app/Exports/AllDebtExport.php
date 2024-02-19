<?php

namespace App\Exports;

use App\Models\Debt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllDebtExport implements FromView
{

    public function view(): View
    {
        return view('dashboard.cetak-laporan.cetak-semua-hutang', [
            'title'         => 'Excel Hutang',
            'judul'         => 'Laporan Hutang',
            'reports'       => Debt::all()
        ]);
    }
}
