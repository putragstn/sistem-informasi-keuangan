@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Hutang - Ubah Data Hutang</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/hutang">Data Hutang</a></li>
            <li class="breadcrumb-item active">Ubah Data Hutang</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Ubah Data Hutang
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/hutang/{{ $debt->id }}" method="POST">

                        @method('put')
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $debt->user_id }}">

                        <div class="mb-3 row">
                            <label for="employee_id" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $debt->employee->nama) }}" required> --}}
                                <select name="employee_id" id="employee_id" class="form-select">
                                    @foreach ($employees as $employee)
                                        @if ($debt->employee_id == $employee->id)
                                            <option value="{{ $employee->id }}" selected>{{ $employee->nama }}</option>
                                        @else
                                            <option value="{{ $employee->id }}" disabled>{{ $employee->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jumlah_hutang" class="col-sm-4 col-form-label">Jumlah Hutang</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control bg-secondary text-light" id="jumlah_hutang" name="jumlah_hutang" value="{{ old('jumlah_hutang', $debt->jumlah_hutang) }}" readonly>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label for="jumlah_bayar" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar', $debt->jumlah_bayar) }}">
                            </div>
                        </div> --}}

                        <div class="mb-3 row">
                            <label for="jatuh_tempo" class="col-sm-4 col-form-label">Tanggal Jatuh Tempo</label>
                            <div class="col-sm-8">
                                {{-- <input type="number" class="form-control" id="jatuh_tempo" name="jatuh_tempo" required> --}}
                                <input type="date" class="form-control" name="jatuh_tempo" value="{{ old('jatuh_tempo', $debt->tgl_jatuh_tempo) }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control bg-secondary text-light" id="alasan" name="alasan" value="{{ old('alasan', $debt->alasan) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="status" name="status">
                                    @if ($debt->status == 1)
                                        <option value="1" selected>Diterima</option>
                                        <option value="2">Diproses</option>
                                        <option value="3">Ditolak</option>
                                    @elseif ($debt->status == 2)
                                        <option value="1">Diterima</option>
                                        <option value="2" selected>Diproses</option>
                                        <option value="3">Ditolak</option>
                                    @else
                                        <option value="1">Diterima</option>
                                        <option value="2">Diproses</option>
                                        <option value="3" selected>Ditolak</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="keterangan" name="keterangan">
                                    @if ($debt->keterangan == "Lunas")
                                        <option value="Lunas" selected>Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    @else
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas" selected>Belum Lunas</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection