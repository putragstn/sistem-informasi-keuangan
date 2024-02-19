@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Edit Biodata</h3>
    <ol class="breadcrumb mb-3">
        @if (auth()->user()->role_id == 1)
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
        @else
            <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
        @endif
        <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
        <li class="breadcrumb-item active">Edit Biodata</li>
    </ol>

    {{-- Row --}}
    <div class="row">
        <div class="col-lg-8">

            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Biodata Saya
                </div>
                <div class="card-body">

                    {{-- Form --}}
                    {{-- Here --}}
                    <form action="/profile/edit-biodata" method="POST">
                        @csrf
                        @method('post')

                        <div class="mb-1 row">
                            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nip" name="nip" disabled value="{{ auth()->user()->employee->nip }}">
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->employee->nama }}">
                            </div>
                        </div>
    
                        <div class="mb-1 row">
                            <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                            <div class="col-sm-8">
                                <select name="jabatan_id" class="form-control" disabled>
                                    <option value="{{ auth()->user()->employee->salary_id }}">{{ auth()->user()->employee->salary->jabatan }}</option>
                                </select>
                                {{-- <input type="text" class="form-control" id="jabatan" name="jabatan" readonly value="{{ $employee->salary->jabatan }}"> --}}
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    @if ($employee->jenis_kelamin == "L")
                                        <option value="L" selected>Laki-Laki</option>
                                        <option value="P">Perempuan</option>    
                                    @else
                                        <option value="L">Laki-Laki</option>
                                        <option value="P" selected>Perempuan</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="tempat_lahir" class="col-sm-4 col-form-label">Tempat & Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $employee->tempat_lahir }}">
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $employee->tgl_lahir }}">
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" rows="2" name="alamat">{{ $employee->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="no_telp" class="col-sm-4 col-form-label">Nomer Handphone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $employee->no_telp }}">
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="no_rek" class="col-sm-4 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="no_rek" name="no_rek" value="{{ $employee->no_rek }}">
                            </div>
                            <div class="col-sm-2">
                                <select name="bank" id="bank" class="form-select">
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
                                    @elseif($employee->bank == "BNI")
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI" selected>BNI</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_masuk" disabled name="tgl_masuk" value="{{ old('tgl_masuk', auth()->user()->employee->tgl_masuk) }}" required>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="status" class="col-sm-4 col-form-label">Status Karyawan</label>
                            <div class="col-sm-8">
                                
                                {{-- <input type="text" class="form-control" id="status" disabled name="status" value="{{ old('status', auth()->user()->employee->status) }}" required> --}}
                                <select name="status" id="status" class="form-select" disabled>
                                    @if (auth()->user()->employee->status == 1)
                                        <option value="1" selected>Karyawan Kontrak</option>
                                        <option value="2" disabled>Karyawan Tetap</option>
                                        <option value="3" disabled>Tidak Aktif</option>
                                    @elseif(auth()->user()->employee->status == 2)
                                        <option value="1" disabled>Karyawan Kontrak</option>
                                        <option value="2" selected>Karyawan Tetap</option>
                                        <option value="3" disabled>Tidak Aktif</option>
                                    @else
                                        <option value="1" disabled>Karyawan Kontrak</option>
                                        <option value="2" disabled>Karyawan Tetap</option>
                                        <option value="3" selected>Tidak Aktif</option>
                                    @endif
                                </select>
                            </div>
                        </div>
    
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                        </div>

                    </form>
                    {{-- End of Form --}}

                </div>
            </div>
            {{-- End Card --}}

        </div>
    </div>
    {{-- End of Row --}}

</div>


@endsection