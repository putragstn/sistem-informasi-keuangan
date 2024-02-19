<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Employee;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.hutang.index', [
            'title' => 'Hutang',
            'debts' => Debt::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $debt = Debt::where('');

        return view('dashboard.hutang.tambah', [
            'title'     => 'Tambah Data Hutang',
            'debts'     => Debt::all(),
            'employees' => Employee::orderBy('nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Debt::create([
            'employee_id'       => $request->nama,
            'jumlah_hutang'     => $request->jumlah_hutang,
            'tgl_pinjam'        => date(now()),
            'tgl_jatuh_tempo'   => $request->jatuh_tempo,
            'keterangan'        => "Belum Lunas"
        ]);
        return redirect('/hutang')->with('success', 'Data Hutang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.hutang.ubah', [
            'title'     => 'Ubah Data Hutang',
            'debt'      => Debt::find($id),
            'employees' => Employee::orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        Debt::where('id', $id)->update([
            'employee_id'       => $request->employee_id,
            'jumlah_hutang'     => $request->jumlah_hutang,
            'tgl_jatuh_tempo'   => $request->jatuh_tempo,
            'keterangan'        => $request->keterangan,
            'alasan'            => $request->alasan,
            'status'            => $request->status
        ]);
        return redirect('/hutang')->with('success', 'Data Hutang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Debt::destroy($id);
        return redirect('/hutang')->with('success', 'Data Hutang berhasil dihapus!');
    }
}
