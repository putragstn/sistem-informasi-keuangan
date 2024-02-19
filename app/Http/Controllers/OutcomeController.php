<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pengeluaran.index', [
            'title'         => 'Data Pengeluaran',
            'outcomes'      => Outcome::all(),
            'categories'    => Category::all(),
            'users'         => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengeluaran.tambah', [
            'title'         => 'Pengeluaran | Tambah Data',
            'categories'    => Category::where('jenis_kategori', '=', 'Pengeluaran')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Outcome::create($request->all());

        return redirect('/data/pengeluaran')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Outcome $outcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.pengeluaran.ubah', [
            'title'         => 'Pengeluaran | Edit Data',
            'outcome'       => Outcome::find($id),
            'categories'    => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'user_id'       => $request->input('user_id'),
            'tanggal'       => $request->input('tanggal'),
            'nominal'       => $request->input('nominal'),
            'category_id'   => $request->input('category_id'),
            'keterangan'    => $request->input('keterangan')
        ];

        Outcome::where('id', $id)->update($data);
        return redirect('/data/pengeluaran')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Outcome::destroy($id);
        return redirect('/data/pengeluaran')->with('success', 'Data berhasil dihapus!');
    }
}
