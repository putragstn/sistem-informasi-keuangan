<?php

namespace App\Exports;

use App\Models\Debt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DebtsExport implements FromView
{
    /*
    |--------------------------------------------------------------------------
    | Atribut dan Method Constructor untuk Menangkap Data
    |--------------------------------------------------------------------------
    |
    | Atribut $start_date dan $end_date digunakan sebagai wadah untuk
    | menampung parameter yang dipassing melalui objek IncomesExport().
    | Setelah data didapatkan dari parameter, data tersebut dimasukan
    | kedalam Method Constructor agar nantinya bisa digunakan oleh
    | method-method yang lain.
    |
    */

    protected $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    /*
    |--------------------------------------------------------------------------
    | Method Export Excel Berdasarkan Tanggal
    |--------------------------------------------------------------------------
    |
    | Dibawah ini merupakan Method untuk mengambil data inocme berdasarkan
    | tanggal awal dan akhir yang user tentukan. Lalu data akan dikembalikan
    | dengan mencetak export excel dan menampilkan view
    |
    */

    public function view(): View
    {
        $debtsByDate = Debt::whereDate('tgl_pinjam', '>=', $this->start_date)
            ->whereDate('tgl_pinjam', '<=', $this->end_date)->where('status', 1)
            ->get();

        return view('dashboard.cetak-laporan.cetak-excel-semua-hutang', [
            'reports'       => $debtsByDate,
            'title'         => 'Excel Hutang',
            'tanggal'       => [
                'awal'  => $this->start_date,
                'akhir' => $this->end_date
            ]
        ]);
    }
}
