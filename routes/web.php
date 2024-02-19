<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployeeSalaryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route Authentication
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'dologin'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Route Halaman Admin & Bendahara
Route::get('/dashboard/admin', [AdminController::class, 'index'])->middleware('admin');
Route::get('/dashboard/bendahara', [PegawaiController::class, 'index'])->middleware('auth');


/**
 * Route Role Karyawan
 * 
 */
Route::get('/dashboard/karyawan', [DashboardKaryawanController::class, 'index'])->middleware('auth');
Route::get('/dashboard/karyawan/profile', [DashboardKaryawanController::class, 'myProfile'])->middleware('auth');
Route::get('/dashboard/karyawan/profile/edit-biodata', [DashboardKaryawanController::class, 'editBiodata'])->middleware('auth');
Route::put('/dashboard/karyawan/profile/edit-biodata/{id}', [DashboardKaryawanController::class, 'updateBiodata'])->middleware('auth');
Route::get('/dashboard/karyawan/profile/edit-account', [DashboardKaryawanController::class, 'editAccount'])->middleware('auth');
Route::put('/dashboard/karyawan/profile/edit-account/{id}', [DashboardKaryawanController::class, 'updateAccount'])->middleware('auth');
Route::get('/dashboard/karyawan/gaji', [DashboardKaryawanController::class, 'mySalary'])->middleware('auth');
Route::get('/dashboard/karyawan/hutang', [DashboardKaryawanController::class, 'myDebt'])->middleware('auth');
Route::post('/dashboard/karyawan/hutang', [DashboardKaryawanController::class, 'pinjam'])->middleware('auth');
Route::get('/dashboard/karyawan/change-password', [DashboardKaryawanController::class, 'editPassword'])->middleware('auth');
Route::post('/dashboard/karyawan/change-password', [DashboardKaryawanController::class, 'updatePassword'])->middleware('auth');


/**
 * Route Profile & Ganti Password (Admin & Bendahara)
 * 
 */
Route::get('/profile', [AdminController::class, 'profile'])->middleware('auth');
Route::get('/profile/edit-account', [AdminController::class, 'editAccount'])->middleware('auth');
Route::get('/profile/edit-biodata', [AdminController::class, 'editBiodata'])->middleware('auth');
Route::post('/profile/edit-account', [AdminController::class, 'updateAccount'])->middleware('auth');
Route::post('/profile/edit-biodata', [AdminController::class, 'updateBiodata'])->middleware('auth');

Route::get('/profile/ganti-password', [AdminController::class, 'editPassword'])->middleware('auth');
Route::post('/profile/ganti-password', [AdminController::class, 'updatePassword'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Route Resource
|--------------------------------------------------------------------------
|
/
*/

Route::resource('/users', UserController::class)->middleware('auth');
Route::resource('/kategori', KategoriController::class)->middleware('auth');
Route::resource('/data/pemasukan', IncomeController::class)->middleware('auth');
Route::resource('/data/pengeluaran', OutcomeController::class)->middleware('auth');
Route::resource('/hutang', DebtController::class)->middleware('auth');
Route::resource('/gaji', SalaryController::class)->middleware('auth');
Route::resource('/karyawan', EmployeeController::class)->middleware('admin');
Route::resource('/gaji-karyawan', EmployeeSalaryController::class)->middleware('auth');


/*
|--------------------------------------------------------------------------
| Route Cetak Laporan: PRINT - PDF - EXCEL
|--------------------------------------------------------------------------
|
| Disini kamu bisa mengatur penjaluran (routing) halaman utama cetak laporan, 
| halaman untuk cetak PRINT, PDF & EXCEL.
|
*/

// Pemasukan - Pengeluaran / Income - Outcome
Route::get('/cetak-laporan', [CetakController::class, 'index'])->middleware('auth');
Route::get('/cetak-laporan/print-income', [CetakController::class, 'printIncome'])->middleware('auth');
Route::get('/cetak-laporan/print-outcome', [CetakController::class, 'printOutcome'])->middleware('auth');
Route::get('/cetak-laporan/pdf-income', [CetakController::class, 'createPDFIncome'])->middleware('auth');
Route::get('/cetak-laporan/pdf-outcome', [CetakController::class, 'createPDFOutcome'])->middleware('auth');
Route::get('/cetak-laporan/excel-income', [CetakController::class, 'excelIncome'])->middleware('auth');
Route::get('/cetak-laporan/excel-outcome', [CetakController::class, 'excelOutcome'])->middleware('auth');

Route::get('/cetak-laporan/print-semua-pemasukan', [CetakController::class, 'printAllIncome'])->middleware('auth');
Route::get('/cetak-laporan/pdf-semua-pemasukan', [CetakController::class, 'allPDFIncome'])->middleware('auth');
Route::get('/cetak-laporan/excel-semua-pemasukan', [CetakController::class, 'allExcelIncome'])->middleware('auth');

Route::get('/cetak-laporan/print-semua-pengeluaran', [CetakController::class, 'printAllOutcome'])->middleware('auth');
Route::get('/cetak-laporan/pdf-semua-pengeluaran', [CetakController::class, 'allPDFOutcome'])->middleware('auth');
Route::get('/cetak-laporan/excel-semua-pengeluaran', [CetakController::class, 'allExcelOutcome'])->middleware('auth');

// Berdasarkan Bulan & Tahun
Route::get('/cetak-print-laporan-income-bulan', [CetakController::class, 'getDataIncomeByMonth'])->middleware('auth');


// Hutang
Route::get('/cetak-laporan/print-hutang', [CetakController::class, 'printDebt'])->middleware('auth');
Route::get('/cetak-laporan/pdf-hutang', [CetakController::class, 'PDFDebt'])->middleware('auth');
Route::get('/cetak-laporan/excel-hutang', [CetakController::class, 'excelDebt'])->middleware('auth');

Route::get('/cetak-laporan/print-semua-hutang', [CetakController::class, 'printAllDebt'])->middleware('auth');
Route::get('/cetak-laporan/pdf-semua-hutang', [CetakController::class, 'allPDFDebt'])->middleware('auth');
Route::get('/cetak-laporan/excel-semua-hutang', [CetakController::class, 'allExcelDebt'])->middleware('auth');

// Gaji Karyawan
Route::get('/cetak-print-gaji-karyawan', [CetakController::class, 'printGajiKaryawan'])->middleware('auth');
Route::get('/cetak-pdf-gaji-karyawan', [CetakController::class, 'gajiKaryawanPDF'])->middleware('auth');
// Route::get('/cetak-print-semua-gaji-karyawan', [CetakController::class, 'printAllGajiKaryawan'])->middleware('auth');

Route::get('cetak-laporan/print-gaji-karyawan', [CetakController::class, 'printSemuaGajiKaryawan'])->middleware('auth');
Route::get('cetak-laporan/pdf-gaji-karyawan', [CetakController::class, 'PDFSemuaGajiKaryawan'])->middleware('auth');
Route::get('cetak-laporan/excel-gaji-karyawan', [CetakController::class, 'excelSemuaGajiKaryawan'])->middleware('auth');
