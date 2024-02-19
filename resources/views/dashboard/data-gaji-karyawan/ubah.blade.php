@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Gaji Karyawan - Ubah Data</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/gaji-karyawan">Data Penggajian Karyawan</a></li>
            <li class="breadcrumb-item active">Ubah Data Penggajian Karyawan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Ubah Data Penggajian Karyawan
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/gaji-karyawan/{{ $employeeSalary->id }}" method="POST">

                        @method('put')
                        @csrf

                        <div class="mb-3 row">
                            <label for="karyawan_id" class="col-sm-4 col-form-label">Nama & Jabatan</label>
                            <div class="col-sm-8">
                                <select name="karyawan_id" id="karyawan_id" class="form-select">
                                    {{-- @foreach ($employees as $employees)
                                        <option value="{{ $employees->id }}">{{ $employees->nama }}</option>
                                    @endforeach --}}
                                    @foreach ($employees as $employee)
                                        @if ($employee->id == $employeeSalary->karyawan_id)
                                            <option value="{{ $employee->id }}" selected>{{ $employee->nama }} - {{ $employeeSalary->salary->jabatan }}</option>
                                        @else
                                            <option value="{{ $employee->id }}">{{ $employee->nama }} - {{ $employeeSalary->salary->jabatan }}</option>
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
                                        @if ($employeeSalary->gaji_id == $salary->id)
                                            <option value="{{ $salary->id }}" selected>@currency($salary->gaji_pokok + $salary->tj_transport + $salary->uang_makan) - {{ $salary->jabatan }}</option>
                                        @else
                                            <option value="{{ $salary->id }}">{{ $salary->jabatan }} - @currency($salary->gaji_pokok + $salary->tj_transport + $salary->uang_makan)</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tgl_gajian" class="col-sm-4 col-form-label">Tanggal Gajian</label>
                            <div class="col-sm-8">
                                <input type="date" id="tgl_gajian" name="tgl_gajian" value="{{ old('tgl_gajian', $employeeSalary->tgl_gajian) }}" class="form-control" required>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label for="uang_makan" class="col-sm-4 col-form-label">Uang Makan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="uang_makan" name="uang_makan" value="{{ old('uang_makan', $salary->uang_makan) }}" required>
                            </div>
                        </div> --}}

                        

                        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection