<?php

namespace App\Exports;

use App\Models\EmployeeSalary;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeSalariesExport implements FromView
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
        $reports = EmployeeSalary::whereDate('tgl_gajian', '>=', $this->start_date)
            ->whereDate('tgl_gajian', '<=', $this->end_date)
            ->get();

        return view('dashboard.cetak-laporan.cetak-excel-semua-gaji-karyawan', [
            'title'         => 'Gaji Karyawan',
            'judul'         => 'Laporan Gaji-Gaji Karyawan',
            'tanggal'       => [
                'awal'  => $this->start_date,
                'akhir' => $this->end_date
            ],
            'reports'       => $reports
        ]);
    }
}
