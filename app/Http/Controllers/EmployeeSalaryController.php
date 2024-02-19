<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Debt;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-gaji-karyawan.index', [
            'title'             => 'Data Penggajian Karyawan',
            'employeeSalaries'  => EmployeeSalary::with('salary', 'employee')->get(),
            'debts'             => Debt::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.data-gaji-karyawan.tambah', [
            'title'     => 'Form Tambah Data Penggajian Karyawan',
            'employees' => Employee::all(),
            'salaries'  => Salary::all(),
            // 'employeeSalaries'  => EmployeeSalary::with('salary', 'employee')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        EmployeeSalary::create($request->all());
        return redirect('/gaji-karyawan')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('dashboard.data-gaji-karyawan.detail', [
            'title'             => 'Detail Gaji Karyawan',
            'employeeSalary'    => EmployeeSalary::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.data-gaji-karyawan.ubah', [
            'title'             => 'Form Tambah Data Penggajian Karyawan',
            'employees'         => Employee::all(),
            'salaries'          => Salary::all(),
            'employeeSalary'    => EmployeeSalary::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            'karyawan_id'   => $request->karyawan_id,
            'gaji_id'       => $request->gaji_id,
            'tgl_gajian'    => $request->tgl_gajian
        ];

        EmployeeSalary::where('id', $id)->update($data);
        return redirect('/gaji-karyawan')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EmployeeSalary::destroy($id);
        return redirect('/gaji-karyawan')->with('success', 'Data berhasil dihapus');
    }
}
