@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Gaji Karyawan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active">Data Penggajian Karyawan</li>
        </ol>
    </nav>
    {{-- End Breadcumb --}}

    {{-- Button --}}
    <div class="d-flex">
        <div class="me-auto me-1">
            <a href="/gaji-karyawan/create" class="btn btn-primary mb-1 me-1">Input Gaji Karyawan</a>
        </div>

        <a href="/gaji" class="btn btn-success mb-1">Data Gaji & Jabatan</a>

        {{-- <div class="dropdown ms-1">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cetak Semua Data Gaji Karyawan
            </button>
            <ul class="dropdown-menu">
                <li>
                    <form action="/cetak-print-semua-gaji-karyawan" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-primary dropdown-item">PRINT</button>
                    </form>
                </li>
                <li>
                    <form action="/cetak-laporan/pdf-semua-pemasukan" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-danger dropdown-item">PDF</button>
                    </form>
                </li>
                <li>
                    <form action="/cetak-laporan/excel-semua-pemasukan" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-success dropdown-item">EXCEL</button>
                    </form>   
                </li>
            </ul>
        </div> --}}
        
    </div>
    {{-- End Button --}}



    <div class="row">
        <div class="col-lg-12">
            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Penggajian Karyawan
                </div>
                <div class="card-body">

                    {{-- Alert / Notifikasi --}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Table --}}
                    <table id="datatablesSimple" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Total Gaji</th>

                                {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                                @if (auth()->user()->role_id == 1)
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Total Gaji</th>

                            {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                            @if (auth()->user()->role_id == 1)
                                <th scope="col">Action</th>
                            @endif
                        </tfoot>
                        <tbody>

                            @foreach ($employeeSalaries as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-M-Y', strtotime($row->tgl_gajian)); }}</td>
                                
                                <td>{{ $row->employee->nama }}</td>
                                <td>{{ $row->salary->jabatan }}</td>

                                <td>@currency($row->salary->gaji_pokok + $row->salary->tj_transport + $row->salary->uang_makan)</td>
                                
                                {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                                @if (auth()->user()->role_id == 1)
                                    <td>
                                        <a href="/gaji-karyawan/{{ $row->id }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="/gaji-karyawan/{{ $row->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                        {{-- Delete Button --}}
                                        <form action="/gaji-karyawan/{{ $row->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Gaji Karyawan Ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
            {{-- End Card --}}
        </div>
    </div>

    
</div>

@endsection