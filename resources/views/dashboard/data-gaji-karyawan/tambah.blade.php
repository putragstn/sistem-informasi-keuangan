@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Gaji Karyawan - Tambah Data</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/gaji-karyawan">Data Penggajian Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Data Penggajian Karyawan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Tambah Data Penggajian Karyawan
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/gaji-karyawan" method="POST">

                        @method('post')
                        @csrf
                        
                        <div class="mb-3 row">
                            <label for="karyawan_id" class="col-sm-4 col-form-label">Nama & Jabatan</label>
                            <div class="col-sm-8">
                                <select name="karyawan_id" id="karyawan_id" class="form-select">
                                    @foreach ($employees as $employee)
                                        @if ($employee->status == TRUE)
                                            <option value="{{ $employee->id }}">{{ $employee->nama }} - {{ $employee->salary->jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="gaji_id" class="col-sm-4 col-form-label">Gaji & Jabatan</label>
                            <div class="col-sm-8">
                                <select name="gaji_id" id="gaji_id" class="form-select">
                                    @foreach ($salaries as $salary)
                                        <option value="{{ $salary->id }}">@currency($salary->gaji_pokok + $salary->tj_transport + $salary->uang_makan) - {{ $salary->jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tgl_gajian" class="col-sm-4 col-form-label">Tanggal Gajian</label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_gajian" class="form-control">
                            </div>
                        </div>

                        

                        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection