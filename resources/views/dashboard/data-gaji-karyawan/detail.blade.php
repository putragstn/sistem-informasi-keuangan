@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Detail Gaji Karyawan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/gaji-karyawan">Data Penggajian Karyawan</a></li>
            <li class="breadcrumb-item active">Detail Gaji Karyawan</li>
        </ol>
    </nav>
    {{-- End Breadcumb --}}

    {{-- <div class="d-flex">
        <div class="me-auto me-1">
            <a href="/gaji-karyawan/create" class="btn btn-primary mb-1 me-1">Input Gaji Karyawan</a>
        </div>
        <a href="/gaji" class="btn btn-success mb-1">Data Gaji & Jabatan</a>
    </div> --}}



    <div class="row">
        <div class="col-lg-12">
            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail Gaji Karyawan
                </div>
                <div class="card-body">

                    {{-- Alert / Notifikasi --}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Nama</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ $employeeSalary->employee->nama }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Jabatan</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ $employeeSalary->salary->jabatan }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Jenis Kelamin</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: 
                            @if ($employeeSalary->employee->jenis_kelamin == "L")
                                Laki-laki
                            @else
                                Perempuan
                            @endif    
                        </h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Kontak</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ $employeeSalary->employee->no_telp }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>No. Rekening</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ $employeeSalary->employee->no_rek }} ({{ $employeeSalary->employee->bank }})</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Tanggal Masuk</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ date('d-F-Y', strtotime($employeeSalary->employee->tgl_masuk)) }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Tanggal Gajian</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: {{ date('d-F-Y', strtotime($employeeSalary->tgl_gajian)) }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"><h6>Status</h6></div>
                        <div class="col-lg-10 col-md-10 col-sm-10"><h6>: 
                            @if ($employeeSalary->employee->status == 1)
                                Karyawan Kontrak
                            @elseif($employeeSalary->employee->status == 2)
                                Karyawan Tetap
                            @else
                                Tidak Aktif
                            @endif    
                        </h6></div>
                    </div>
                    

                    {{-- Table --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <td>Gaji Pokok</td>
                                        <td>@currency($employeeSalary->salary->gaji_pokok)</td>
                                    </tr>
                                </thead>
                                <tbody>
        
                                    <tr>
                                        <td>Tunjangan Transport</td>
                                        <td>@currency($employeeSalary->salary->tj_transport)</td>
                                    </tr>
                                    <tr>
                                        <td>Uang Makan</td>
                                        <td>@currency($employeeSalary->salary->uang_makan)</td>
                                    </tr>
                                    <tr>
                                        <th>Total Gaji</th>
                                        <th>
                                            @currency($employeeSalary->salary->gaji_pokok + $employeeSalary->salary->tj_transport +  $employeeSalary->salary->uang_makan)
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- End Table --}}

                    {{-- Button --}}
                    <div class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cetak Gaji {{ $employeeSalary->employee->nama }}
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <form action="/cetak-print-gaji-karyawan">
                                        @method('GET')
                                        <input type="hidden" name="id" value="{{ $employeeSalary->id }}">
                                        <button type="submit" class="btn btn-primary pe-5">PRINT</button>
                                    </form>
                                </li>
                                <li class="dropdown-item">
                                    <form action="/cetak-pdf-gaji-karyawan">
                                        @method('GET')
                                        <input type="hidden" name="id" value="{{ $employeeSalary->id }}">
                                        <button type="submit" class="btn btn-danger pe-5">PDF</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                    {{-- End Button --}}

                </div>
            </div>
            {{-- End Card --}}
        </div>
    </div>

    
</div>

@endsection