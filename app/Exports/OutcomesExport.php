<?php

namespace App\Exports;

use App\Models\Outcome;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OutcomesExport implements FromView
{
    protected $start_date, $end_date;

    // Constuctor
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Outcome::all();
    // }

    public function view(): View
    {
        $outcomesByDate = Outcome::whereDate('tanggal', '>=', $this->start_date)
            ->whereDate('tanggal', '<=', $this->end_date)
            ->get();

        return view('dashboard.cetak-laporan.cetak-excel-semua-pengeluaran', [
            'reports'       => $outcomesByDate,
            'total'         => $outcomesByDate->sum('nominal'),
            'categories'    => Category::all(),
            'title'         => 'Excel Pengeluaran',
            'tanggal'       => [
                'awal'  => $this->start_date,
                'akhir' => $this->end_date
            ]
        ]);
    }
}
