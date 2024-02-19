<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\User;
use App\Models\Debt;
use App\Models\Employee;
use Carbon\Carbon;

class AdminController extends Controller
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

        // Sum All Income & Outcome
        $totalIncome = Income::all()->sum('nominal');
        $totalOutcome = Outcome::all()->sum('nominal');

        // getDataByMonth


        return view('dashboard.index', [
            'title'             => 'Dashboard | Admin',
            'sumDailyIncome'    => $dailyIncome,
            'sumWeeklyIncome'   => $weeklyIncome,
            'sumMonthlyIncome'  => $monthlyIncome,
            'sumDailyOutcome'   => $dailyOutcome,
            'sumWeeklyOutcome'  => $weeklyOutcome,
            'sumMonthlyOutcome' => $monthlyOutcome,
            'totalUser'         => User::count(),
            'totalPeminjam'     => Debt::count(),
            'jumlahKaryawan'    => Employee::count(),
            'totalIncome'       => $totalIncome,
            'totalOutcome'      => $totalOutcome,
            'pendapatanBersih'  => $totalIncome - $totalOutcome
        ]);
    }


    /**
     * Method for Profile
     */
    public function profile()
    {
        return view('dashboard.data-user.profile', [
            'title'     => 'My Profile',
            'employee'  => Employee::find(auth()->user()->employee_id)
        ]);
    }

    public function editAccount()
    {
        return view('dashboard.data-user.edit-account', [
            'title'     => 'Edit Profile Account',
            'employee'  => Employee::find(auth()->user()->employee_id)
        ]);
    }

    public function updateAccount(Request $request)
    {
        $data = [
            // auth()->user() digunakan untuk mengambil data saat ini yang sedang login
            // $request merupakan data terbaru yang diambil dari form input
            'role_id'       => auth()->user()->role_id,
            'employee_id'   => auth()->user()->employee_id,
            'email'         => $request->email,
            'password'      => auth()->user()->password
        ];

        // update tabel user dimana id = id user yang sedang login
        User::where('id', auth()->user()->id)->update($data);
        return redirect('/profile')->with('success', 'Informasi Akun berhasil diubah');
    }

    public function editBiodata()
    {
        return view('dashboard.data-user.edit-biodata', [
            'title'     => 'Edit Biodata',
            'employee'  => Employee::find(auth()->user()->employee_id)
        ]);
    }

    public function updateBiodata(Request $request)
    {
        $data = [
            // 'user_id'       => $request->user_id,
            'salary_id'     => auth()->user()->employee->salary_id,
            'nip'           => auth()->user()->employee->nip,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'tgl_masuk'     => auth()->user()->employee->tgl_masuk,
            'alamat'        => $request->alamat,
            'no_rek'        => $request->no_rek,
            'bank'          => $request->bank,
            'status'        => auth()->user()->employee->status
        ];

        Employee::where('id', auth()->user()->employee_id)->update($data);
        return redirect('/profile')->with('success', 'Biodata berhasil diubah');
    }


    /**
     * Method for Change Password
     */
    public function editPassword()
    {
        return view('dashboard.data-user.ganti-password', [
            'title' => 'Ganti Password',
            // 'user'  => User::find(auth()->user()->id)
        ]);
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password changed successfully!");
    }
}
