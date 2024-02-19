@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Karyawan - Tambah Data Karyawan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/karyawan">Data Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Data Karyawan</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tambah Data Karyawan
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/karyawan" method="POST">

                        @method('post')
                        @csrf
                        
                        <div class="mb-3 row">
                            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jabatan_id" class="col-sm-4 col-form-label">Jabatan</label>
                            <div class="col-sm-8">
                                <select name="jabatan_id" id="jabatan_id" class="form-select">
                                    @foreach ($salaries as $salary)
                                        <option value="{{ $salary->id }}">{{ $salary->jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Tempat & Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tempat_lahir" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tgl_lahir" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" rows="2" name="alamat"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_telp" class="col-sm-4 col-form-label">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="no_telp" name="no_telp" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_rek" class="col-sm-4 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="no_rek" name="no_rek" required>
                            </div>
                            <div class="col-sm-3">
                                <select name="bank" class="form-select">
                                    <option value="BCA">BCA</option>
                                    <option value="BRI">BRI</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="BNI">BNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
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