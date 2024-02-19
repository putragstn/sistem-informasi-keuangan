<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.gaji.index', [
            'title'     => 'Gaji',
            'salaries'  => Salary::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gaji.tambah', [
            'title'     => 'Form Tambah Gaji'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Salary::create($request->all());
        return redirect('/gaji')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.gaji.ubah', [
            'title'     => 'Form Ubah Gaji',
            'salary'    => Salary::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            'jabatan'       => $request->jabatan,
            'gaji_pokok'    => $request->gaji_pokok,
            'tj_transport'  => $request->tj_transport,
            'uang_makan'    => $request->uang_makan
        ];
        Salary::where('id', $id)->update($data);
        return redirect('/gaji')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Salary::destroy($id);
        return redirect('/gaji')->with('success', 'Data berhasil dihapus');
    }
}
