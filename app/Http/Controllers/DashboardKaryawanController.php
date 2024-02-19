<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardKaryawanController extends Controller
{
    /**
     * Method Controller untuk Menu Dashboard Karyawan
     * 
     */
    public function index()
    {
        return view('dashboard-karyawan.index', [
            'title'          => 'Dashboard Karyawan',
            'employee'       => Employee::find(auth()->user()->employee_id),
            'employeeSalary' => EmployeeSalary::where('karyawan_id', auth()->user()->employee_id)->get(),
            'employeeDebts'  => Debt::where('employee_id', auth()->user()->employee_id)->get()
        ]);
    }



    /**
     * Method Controller untuk Menu Profile Karyawan
     * 
     */
    public function myProfile()
    {
        return view('dashboard-karyawan.profile', [
            'title'     => 'Dashboard Karyawan | Profile',
            'employee'  => Employee::find(auth()->user()->employee_id)
        ]);
    }

    public function editBiodata()
    {
        return view('dashboard-karyawan.edit-biodata', [
            'title'     => 'Dashboard Karyawan | Edit Biodata',
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
        return redirect('/dashboard/karyawan/profile')->with('success', 'Biodata berhasil diubah');
    }

    public function editAccount()
    {
        return view('dashboard-karyawan.edit-account', [
            'title'     => 'Dashboard Karyawan | Edit Profile Account',
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
        return redirect('/dashboard/karyawan/profile')->with('success', 'Informasi Akun berhasil diubah');
    }


    /**
     * Method Controller untuk Menu Gaji Saya
     */
    public function mySalary()
    {
        // $employee = Employee::find(auth()->user()->id);

        return view('dashboard-karyawan.salary', [
            'title'             => 'Dashboard Karyawan | Gaji',
            'employeeSalary'    => EmployeeSalary::where('karyawan_id', auth()->user()->employee_id)->get()
        ]);
    }


    /**
     * Method Controller untuk menu Pinjam Hutang
     * 
     */
    public function myDebt()
    {
        return view('dashboard-karyawan.debt', [
            'title'         => 'Dashboard Karyawan | Hutang',
            'employeeDebts' => Debt::where('employee_id', auth()->user()->employee_id)->get()
        ]);
    }

    public function pinjam(Request $request)
    {
        Debt::create([
            // mengambil employee_id user yang sedang login
            'employee_id'       => auth()->user()->employee_id,
            'jumlah_hutang'     => $request->jumlah_hutang,
            'tgl_pinjam'        => date(now()),
            // 'tgl_jatuh_tempo'   => $request->jatuh_tempo,  NULLABLE
            'keterangan'        => "Belum Lunas",
            'alasan'            => $request->alasan,
            'status'            => 2
        ]);

        return redirect('/dashboard/karyawan/hutang')->with('success', 'Hutang berhasil diajukan');
    }

    public function editPassword()
    {
        return view('dashboard-karyawan.change-password', [
            'title' => 'Ganti Password Karyawan',
            // 'users' => Employee::find(auth()->user()->employee_id)
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
