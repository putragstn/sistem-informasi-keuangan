<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\User;
use App\Models\Debt;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        // Income - Pemasukan - Pendapatan
        $dailyIncome = Income::whereDate('tanggal', Carbon::today())->sum('nominal');
        $weeklyIncome = Income::whereBetween('tanggal', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('nominal');
        $monthlyIncome = Income::whereMonth('tanggal', date('m'))->sum('nominal');

        // Outcome - Pengeluaran
        $dailyOutcome = Outcome::whereDate('tanggal', Carbon::today())->sum('nominal');
        $weeklyOutcome = Outcome::whereBetween('tanggal', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('nominal');
        $monthlyOutcome = Outcome::whereMonth('tanggal', date('m'))->sum('nominal');

        $totalIncome = Income::all()->sum('nominal');
        $totalOutcome = Outcome::all()->sum('nominal');


        return view('dashboard.index', [
            'title'             => 'Dashboard',
            'sumDailyIncome'    => $dailyIncome,
            'sumWeeklyIncome'   => $weeklyIncome,
            'sumMonthlyIncome'  => $monthlyIncome,
            'sumDailyOutcome'   => $dailyOutcome,
            'sumWeeklyOutcome'  => $weeklyOutcome,
            'sumMonthlyOutcome' => $monthlyOutcome,
            'totalUser'         => User::count(),
            'totalPeminjam'     => Debt::count(),
            'totalIncome'       => $totalIncome,
            'totalOutcome'      => $totalOutcome,
            'pendapatanBersih'  => $totalIncome - $totalOutcome
        ]);
    }
}
