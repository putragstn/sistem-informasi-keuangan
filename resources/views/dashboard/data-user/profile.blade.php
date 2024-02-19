@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">

    {{-- @dd($user) --}}

    <h1 class="mt-4">Profile</h1>
    <ol class="breadcrumb mb-3">
        @if (auth()->user()->role_id == 1)
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
        @else
            <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
        @endif
        <li class="breadcrumb-item active">Profile</li>
    </ol>

    {{-- Row --}}
    <div class="row">
        <div class="col-lg-12">

            {{-- Alert / Notifikasi --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="col-lg-6">

            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Informasi Akun
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4 fw-bold">Nama</div>
                        <div class="col-lg-8 mb-1">: {{ auth()->user()->employee->nama }}</div>

                        <div class="col-lg-4 fw-bold">Email</div>
                        <div class="col-lg-8 mb-1">: {{ auth()->user()->email }}</div>

                        <div class="col-lg-4 fw-bold">Role</div>
                        <div class="col-lg-8 mb-1">: {{ auth()->user()->role->role_name }}</div>

                        <div class="text-center mt-1">
                            <hr>
                            <a href="/profile/edit-account" class="btn btn-sm btn-primary mb-1">Edit Informasi Akun</a>
                        </div>
                        
                    </div>

                </div>
            </div>
            {{-- End Card --}}

        </div>

        <div class="col-lg-6">

            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Biodata Saya
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4 fw-bold">NIP</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->nip }}</div>

                        <div class="col-lg-4 fw-bold">Nama</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->nama }}</div>

                        <div class="col-lg-4 fw-bold">Jabatan</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->salary->jabatan }}</div>

                        <div class="col-lg-4 fw-bold">Jenis Kelamin</div>
                        <div class="col-lg-8 mb-1">: 
                            @if ($employee->jenis_kelamin == "L" || $employee->jenis_kelamin == "l")
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </div>

                        <div class="col-lg-4 fw-bold">Tempat & Tgl Lahir</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->tempat_lahir }}, {{ date('d-M-Y', strtotime($employee->tgl_lahir)) }}</div>

                        <div class="col-lg-4 fw-bold">Alamat</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->alamat }}</div>

                        <div class="col-lg-4 fw-bold">Nomer Handphone</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->no_telp }}</div>

                        <div class="col-lg-4 fw-bold">Nomer Rekening</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->no_rek }}</div>

                        <div class="col-lg-4 fw-bold">Bank</div>
                        <div class="col-lg-8 mb-1">: {{ $employee->bank }}</div>

                        <div class="col-lg-4 fw-bold">Tanggal Masuk</div>
                        <div class="col-lg-8 mb-1">: {{ date('d-M-Y', strtotime($employee->tgl_masuk)) }}</div>

                        <div class="col-lg-4 fw-bold">Status Karyawan</div>
                        <div class="col-lg-8 mb-1">: 
                            @if ($employee->status == 1)
                                <span class="badge text-bg-primary">Karyawan Kontrak</span>
                            @elseif($employee->status == 2)
                                <span class="badge text-bg-success">Karyawan Tetap</span>
                            @else
                                <span class="badge text-bg-danger">Tidak Aktif</span>
                            @endif
                        </div>

                        <div class="text-center mt-1">
                            <hr>
                            <a href="/profile/edit-biodata" class="btn btn-sm btn-primary mb-1">Edit Biodata Saya</a>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Card --}}

        </div>
    </div>
    {{-- End of Row --}}

</div>

@endsection