@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Hutang - Tambah Data Hutang</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/hutang">Data Hutang</a></li>
            <li class="breadcrumb-item active">Tambah Data Hutang</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Tambah Data Hutang
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/hutang" method="POST">

                        @method('post')
                        @csrf

                        {{-- Mengambil ID User yang sedang login  --}}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="nama">
                                    @foreach ($employees as $employee)

                                        {{-- Data Yang tampil adalah karyawan yg memiliki status aktif --}}
                                        @if ($employee->status == TRUE)
                                            <option value="{{ $employee->id }}">{{ $employee->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jumlah_hutang" class="col-sm-4 col-form-label">Jumlah Hutang</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="jumlah_hutang" name="jumlah_hutang" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jatuh_tempo" class="col-sm-4 col-form-label">Tanggal Jatuh Tempo</label>
                            <div class="col-sm-8">
                                {{-- <input type="number" class="form-control" id="jatuh_tempo" name="jatuh_tempo" required> --}}
                                <input type="date" class="form-control" name="jatuh_tempo" required>
                            </div>
                        </div>
                        

                        {{-- <div class="mb-3 row">
                            <label for="jumlah_bayar" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required>
                            </div>
                        </div> --}}

                        {{-- <div class="mb-3 row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="keterangan" name="keterangan" aria-readonly="true">
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                </select>
                            </div>
                        </div> --}}


                        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection