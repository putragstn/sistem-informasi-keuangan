<?php

namespace App\Http\Controllers;

use App\Exports\IncomesExport;
use App\Exports\OutcomesExport;
use App\Exports\DebtsExport;
use App\Exports\AllDebtExport;
use App\Exports\AllIncomeExport;
use App\Exports\AllOutcomeExport;
use App\Exports\EmployeeSalariesExport;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\EmployeeSalary;
use App\Models\Debt;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

// Library
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class CetakController extends Controller
{
    public function index()
    {
        return view('dashboard.cetak-laporan.index', [
            'title' => 'Keuangan | Cetak Laporan'
        ]);
    }

    /*
        - PRINT -
    */
    /*
    |--------------------------------------------------------------------------
    | PRINT DATA INCOME & OUTCOME BY DATE
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    */

    public function printIncome(Request $request)
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        $reports = Income::whereDate('tanggal', '>=', $start_date)
            ->whereDate('tanggal', '<=', $end_date)
            ->get();
        $categories = Category::all();

        return view('dashboard.cetak-laporan.cetak', [
            'title'         => 'Print Pemasukan',
            'judul'         => 'Laporan Pemasukan',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'categories'    => Category::all(),
            'total'         => $reports->sum('nominal'),
            'reports'       => $reports
        ], compact('reports'));
    }

    public function printOutcome(Request $request)
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Mencari Data berdasarkan kondisi tanggal
        $reports = Outcome::whereDate('tanggal', '>=', $start_date)
            ->whereDate('tanggal', '<=', $end_date)
            ->get();

        return view('dashboard.cetak-laporan.cetak', [
            'title'         => 'Print Pengeluaran',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'judul'         => 'Laporan Pengeluaran',
            'categories'    => Category::all(),
            'total'         => $reports->sum('nominal'),
            'reports'       => $reports
        ], compact('reports'));
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF INCOME & OUTCOME BY DATE
    |--------------------------------------------------------------------------
    |
    | Dibawah ini ada 2 Method untuk Mencetak PDF Income dan PDF Outcome.
    | Untuk bisa mencetak PDF Income atau Outcome, User harus menentukan
    | tanggal awal dan akhir sebelum mencetak sebagai PDF.
    |
    */

    function createPDFIncome()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Mencari Data berdasarkan kondisi tanggal
        $data = Income::whereDate('tanggal', '>=', $start_date)
            ->whereDate('tanggal', '<=', $end_date)
            ->get();

        // share data to view
        // view()->share('income', $data);
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-pdf-semua-pemasukan', [
            'title'         => 'PDF Pemasukan',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'judul'         => 'Laporan Pemasukan',
            'total'         => $data->sum('nominal'),
            'categories'    => Category::all(),
            'reports'       => $data
        ]);
        // download PDF file with download method
        return $pdf->download('pemasukan_pdf_file.pdf');
    }

    function createPDFOutcome()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Mencari Data berdasarkan kondisi tanggal
        $data = Outcome::whereDate('tanggal', '>=', $start_date)
            ->whereDate('tanggal', '<=', $end_date)
            ->get();

        // share data to view
        // view()->share('income', $data);
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-pdf-semua-pengeluaran', [
            'title'         => 'PDF Pengeluaran',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'judul'         => 'Laporan Pengeluaran',
            'total'         => $data->sum('nominal'),
            'categories'    => Category::all(),
            'reports'       => $data
        ]);
        // download PDF file with download method
        return $pdf->download('pengeluaran_pdf_file.pdf');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL INCOME & OUTCOME
    |--------------------------------------------------------------------------
    |
    | Terdapat 2 method method dibawah ini, yang masing-masing untuk
    | meng-export Income menjadi File Excel dan Outcome menjadi Excel.
    | Data yang akan dicetak berasal dari tanggal yang user tentukan
    |
    */

    public function excelIncome()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // download excel
        return Excel::download(new IncomesExport($start_date, $end_date), 'income.xlsx');
    }

    public function excelOutcome()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // download excel
        return Excel::download(new OutcomesExport($start_date, $end_date), 'outcome.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT DEBT
    |--------------------------------------------------------------------------
    |
    |
    */

    function printDebt()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        $reports = Debt::whereDate('tgl_pinjam', '>=', $start_date)
            ->whereDate('tgl_pinjam', '<=', $end_date)->where('status', 1)->get();

        return view('dashboard.cetak-laporan.cetak-hutang', [
            'title'         => 'Print Hutang',
            'judul'         => 'Laporan Hutang',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'reports'       => $reports
        ]);
    }

    function PDFDebt()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Mencari Data berdasarkan kondisi tanggal
        $data = Debt::whereDate('tgl_pinjam', '>=', $start_date)
            ->whereDate('tgl_pinjam', '<=', $end_date)->where('status', 1)
            ->get();

        // share data to view
        // view()->share('income', $data);
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-pdf-semua-hutang', [
            'title'         => 'PDF Hutang',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'judul'         => 'Laporan Hutang',
            'reports'          => $data
        ]);

        // convert date to dd-mm-yyyy
        $start = date('d-m-Y', strtotime($start_date));
        $end = date('d-m-Y', strtotime($end_date));

        // download PDF file with download method
        return $pdf->download('hutang_periode_' . $start . ' sampai ' . $end . '.pdf');
    }

    function excelDebt()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // convert date to dd-mm-yyyy
        $start = date('d-m-Y', strtotime($start_date));
        $end = date('d-m-Y', strtotime($end_date));

        // download excel
        return Excel::download(new DebtsExport($start_date, $end_date), 'hutang_periode_' . $start . ' sampai ' . $end . '.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT ALL DEBT
    |--------------------------------------------------------------------------
    |
    |
    */
    function allPDFDebt()
    {
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-semua-hutang', [
            'title'         => 'PDF Hutang',
            'judul'         => 'Laporan Hutang',
            'reports'       => Debt::all()
        ]);

        // download PDF file with download method
        return $pdf->download('semua_data_hutang.pdf');
    }

    function printAllDebt()
    {
        return view('dashboard.cetak-laporan.cetak-semua-hutang', [
            'title'         => 'PDF Hutang',
            'judul'         => 'Laporan Hutang',
            'reports'       => Debt::all()
        ]);
    }

    function allExcelDebt()
    {
        // download excel
        return Excel::download(new AllDebtExport(), 'semua-hutang.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT ALL INCOME
    |--------------------------------------------------------------------------
    |
    |
    */

    function printAllIncome()
    {
        return view('dashboard.cetak-laporan.cetak-semua-pemasukan', [
            'title'         => 'Print Pemasukan',
            'judul'         => 'Laporan Pemasukan',
            'reports'       => Income::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);
    }

    function allPDFIncome()
    {
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-semua-pemasukan', [
            'title'         => 'Print Pemasukan',
            'judul'         => 'Laporan Pemasukan',
            'reports'       => Income::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);

        // download PDF file with download method
        return $pdf->download('semua_data_pemasukan.pdf');
    }

    function allExcelIncome()
    {
        // download excel
        return Excel::download(new AllIncomeExport(), 'semua-pemasukan.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT ALL OUTCOME
    |--------------------------------------------------------------------------
    |
    |
    */

    function printAllOutcome()
    {
        return view('dashboard.cetak-laporan.cetak-semua-pengeluaran', [
            'title'         => 'Print Pengeluaran',
            'judul'         => 'Laporan Pengeluaran',
            'reports'       => Outcome::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);
    }

    function allPDFOutcome()
    {
        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-semua-pengeluaran', [
            'title'         => 'PDF Pengeluaran',
            'judul'         => 'Laporan Pengeluaran',
            'reports'       => Outcome::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);

        // download PDF file with download method
        return $pdf->download('semua_data_pengeluaran.pdf');
    }

    function allExcelOutcome()
    {
        // download excel
        return Excel::download(new AllOutcomeExport(), 'semua-pengeluaran.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | REPORT PRINT & PDF EMPLOYEE SALARY
    |--------------------------------------------------------------------------
    |
    |
    */

    public function printGajiKaryawan(Request $request)
    {
        return view('dashboard.cetak-laporan.cetak-gaji-karyawan', [
            'title'         => 'Gaji Karyawan',
            'data'          => EmployeeSalary::find($request->id)
        ]);
    }

    public function gajiKaryawanPDF(Request $request)
    {

        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-gaji-karyawan', [
            'title'         => 'Gaji Karyawan',
            'data'          => EmployeeSalary::find($request->id)
        ]);

        return $pdf->download('gaji-karyawan.pdf');
    }

    public function printAllGajiKaryawan()
    {
        return view('dashboard.cetak-laporan.cetak-semua-gaji-karyawan', [
            'title'             => 'Gaji Karyawan',
            'reports'           => EmployeeSalary::all()
        ]);
    }

    // public function getDataIncomeByMonth(Request $request)
    // {
    //     return dd($request->bulan_tahun);
    // }

    public function printSemuaGajiKaryawan()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Data Gaji Karyawan
        $reports = EmployeeSalary::whereDate('tgl_gajian', '>=', $start_date)
            ->whereDate('tgl_gajian', '<=', $end_date)
            ->get();

        return view('dashboard.cetak-laporan.cetak-semua-gaji-karyawan', [
            'title'         => 'Print Gaji Karyawan',
            'judul'         => 'Laporan Gaji-Gaji Karyawan',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'reports'       => $reports
        ]);
    }

    public function PDFSemuaGajiKaryawan()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        // Data Gaji Karyawan
        $reports = EmployeeSalary::whereDate('tgl_gajian', '>=', $start_date)
            ->whereDate('tgl_gajian', '<=', $end_date)
            ->get();

        $pdf = PDF::loadView('dashboard.cetak-laporan.cetak-pdf-semua-gaji-karyawan', [
            'title'         => 'Print Gaji Karyawan',
            'judul'         => 'Laporan Gaji-Gaji Karyawan',
            'tanggal'       => [
                'awal'  => $start_date,
                'akhir' => $end_date
            ],
            'reports'       => $reports
        ]);

        return $pdf->download('data-data-gaji-karyawan.pdf');
    }

    public function excelSemuaGajiKaryawan()
    {
        // Tangkap Input Tanggal Awal dan Akhir
        $start_date = Carbon::parse(request()->input('tglAwal'))->toDateTimeString();
        $end_date = Carbon::parse(request()->input('tglAkhir'))->toDateTimeString();

        return Excel::download(new EmployeeSalariesExport($start_date, $end_date), 'data-data-gaji-karyawan.xlsx');
    }
}
