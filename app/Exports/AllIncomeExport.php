<?php

namespace App\Exports;

use App\Models\Income;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllIncomeExport implements FromView
{

    public function view(): View
    {
        return view('dashboard.cetak-laporan.cetak-semua-pemasukan', [
            'title'         => 'Excel Pemasukan',
            'judul'         => 'Laporan Pemasukan',
            'reports'       => Income::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);
    }
}
