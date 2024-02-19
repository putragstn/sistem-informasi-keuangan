<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\EmployeeSalary;
use App\Models\Debt;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-karyawan.index', [
            'title'     => 'Data Karyawan',
            'employees' => Employee::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.data-karyawan.tambah', [
            'title'     => 'Form Tambah Karyawan',
            'salaries'  => Salary::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            // 'user_id'       => auth()->user()->id,
            'salary_id'     => $request->jabatan_id,
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'tgl_masuk'     => $request->tgl_masuk,
            'alamat'        => $request->alamat,
            'no_rek'        => $request->no_rek,
            'bank'          => $request->bank
        ];

        Employee::create($data);
        return redirect('/karyawan')->with('success', 'Data Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, $id)
    {
        return view('dashboard.data-karyawan.detail', [
            'title'             => 'Detail Karyawan',
            'employee'          => Employee::find($id),
            'employeeSalary'    => EmployeeSalary::where('karyawan_id', $id)->get(),
            'employeeDebt'      => Debt::where('employee_id', $id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.data-karyawan.ubah', [
            'title'     => 'Form Ubah Karyawan',
            'employee'  => Employee::find($id),
            'salaries'  => Salary::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            // 'user_id'       => $request->user_id,
            'salary_id'     => $request->jabatan_id,
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'tgl_masuk'     => $request->tgl_masuk,
            'alamat'        => $request->alamat,
            'no_rek'        => $request->no_rek,
            'bank'          => $request->bank,
            'status'        => $request->status
        ];

        Employee::where('id', $id)->update($data);
        return redirect('/karyawan')->with('success', 'Data Karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect('/karyawan')->with('success', 'Data Karyawan berhasil dihapus');
    }
}
