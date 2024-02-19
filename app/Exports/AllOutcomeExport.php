<?php

namespace App\Exports;

use App\Models\Income;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllOutcomeExport implements FromView
{

    public function view(): View
    {
        return view('dashboard.cetak-laporan.cetak-semua-pengeluaran', [
            'title'         => 'Excel Pengeluaran',
            'judul'         => 'Laporan Pengeluaran',
            'reports'       => Income::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);
    }
}
