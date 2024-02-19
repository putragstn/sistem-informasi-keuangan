@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Karyawan - Ubah Data Karyawan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/karyawan">Data Karyawan</a></li>
            <li class="breadcrumb-item active">Ubah Data Karyawan</li>
        </ol>
    </nav>
    {{-- End Breacrumb --}}

    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ubah Data Karyawan
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/karyawan/{{ $employee->id }}" method="POST">

                        @method('put')
                        @csrf

                        {{-- <input type="hidden" name="user_id" value="{{ $employee->user_id }}"> --}}

                        <div class="mb-3 row">
                            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $employee->nip) }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $employee->nama) }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jabatan_id" class="col-sm-4 col-form-label">Jabatan</label>
                            <div class="col-sm-8">
                                <select name="jabatan_id" id="jabatan_id" class="form-select">
                                    @foreach ($salaries as $salary)
                                        @if ($employee->salary_id == $salary->id)
                                            <option value="{{ $salary->id }}" selected>{{ $salary->jabatan }}</option>
                                        @else
                                            <option value="{{ $salary->id }}">{{ $salary->jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    @if ($employee->jenis_kelamin == "L")
                                        <option value="L" selected>Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    @else
                                        <option value="L">Laki-laki</option>
                                        <option value="P" selected>Perempuan</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Tempat & Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $employee->tempat_lahir) }}" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir', $employee->tgl_lahir) }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" rows="2" name="alamat">{{ old('alamat', $employee->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_telp" class="col-sm-4 col-form-label">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $employee->no_telp) }}" required>
                            </div>
                        </div>

                        {{-- No. Rek & Bank --}}
                        <div class="mb-3 row">
                            <label for="no_rek" class="col-sm-4 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="no_rek" name="no_rek" value="{{ old('no_rek', $employee->no_rek) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <select name="bank" class="form-select">
                                    @if ($employee->bank == "BCA")
                                        <option value="BCA" selected>BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                    @elseif($employee->bank == "BRI")
                                        <option value="BCA">BCA</option>
                                        <option value="BRI" selected>BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                    @elseif($employee->bank == "Mandiri")
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri" selected>Mandiri</option>
                                        <option value="BNI">BNI</option>
                                    @else
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI" selected>BNI</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-- End of No. Rek & Bank --}}

                        <div class="mb-3 row">
                            <label for="tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk', $employee->tgl_masuk) }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="status" class="col-sm-4 col-form-label">Status Karyawan</label>
                            <div class="col-sm-8">
                                <select name="status" id="status" class="form-select">
                                    @if ($employee->status == 1)
                                        <option value="1" selected>Karyawan Kontrak</option>
                                        <option value="2">Karyawan Tetap</option>
                                        <option value="3">Tidak Aktif</option>
                                    @elseif($employee->status == 2)
                                        <option value="1">Karyawan Kontrak</option>
                                        <option value="2" selected>Karyawan Tetap</option>
                                        <option value="3">Tidak Aktif</option>
                                    @else
                                        <option value="1">Karyawan Kontrak</option>
                                        <option value="2">Karyawan Tetap</option>
                                        <option value="3" selected>Tidak Aktif</option>
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