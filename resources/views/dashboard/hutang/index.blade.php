@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Hutang</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active">Data Hutang</li>
        </ol>
    {{-- End Breadcumb --}}

    {{-- Button --}}
    <div class="d-flex">
        {{-- <div class="me-auto">
            <a href="/hutang/create" class="btn btn-primary mb-1">Tambah Data Hutang</i></a>
        </div> --}}

        {{-- <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cetak Semua Data Hutang
            </button>
            <ul class="dropdown-menu">
                <li>
                    <form action="/cetak-laporan/pdf-semua-hutang" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-danger dropdown-item">PDF</button>
                    </form>
                </li>
                <li>
                    <form action="/cetak-laporan/print-semua-hutang" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-warning dropdown-item">PRINT</button>
                    </form>
                </li>
                <li>
                    <form action="/cetak-laporan/excel-semua-hutang" method="GET">
                        @method('get')
                        <button type="submit" class="btn btn-success dropdown-item">EXCEL</button>
                    </form>
                </li>
            </ul>
        </div> --}}
    </div>
    {{-- End Button --}}


    {{-- Card --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Hutang
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
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Jumlah Hutang</th>
                        <th scope="col">Jatuh Tempo</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                        {{-- <th scope="col">Operator</th> --}}

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tgl Pinjam</th>
                    <th scope="col">Jumlah Hutang</th>
                    <th scope="col">Jatuh Tempo</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>

                    <th scope="col">Action</th>
                </tfoot>
                <tbody>

                    @foreach ($debts as $debt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $debt->employee->nama }}</td>
                            <td>{{ date('d/M/Y', strtotime($debt->tgl_pinjam)) }}</td>
                            <td>@currency($debt->jumlah_hutang)</td>

                            <td>
                                @if ($debt->tgl_jatuh_tempo == NULL)
                                -
                                @else

                                    {{-- jika tgl jatuhnya tempo sudah lewat tapi hutang sudah lunas --}}
                                    @if ($debt->tgl_jatuh_tempo <= date('Y-m-d') && $debt->keterangan == "Lunas")
                                        <span class="text-bg-success p-1">{{ date('d/m/Y', strtotime($debt->tgl_jatuh_tempo)) }}</span>

                                    {{-- Jika Tgl Jatuh Tempo Sudah Lewat dengan tanggal sekarang --}}
                                    @elseif ($debt->tgl_jatuh_tempo <= date('Y-m-d'))
                                        <span class="text-bg-danger p-1">{{ date('d/m/Y', strtotime($debt->tgl_jatuh_tempo)) }}</span>
                                    @else
                                        {{ date('d/m/Y', strtotime($debt->tgl_jatuh_tempo)) }}
                                    @endif
                                    
                                @endif
                            </td>

                            <td>{{ $debt->alasan }}</td>
                            <td>
                                @if ($debt->status === 1)
                                    <span class="badge text-bg-success">Diterima</span>
                                @elseif($debt->status === 2)
                                    <span class="badge text-bg-primary">Diproses</span>
                                @else
                                    <span class="badge text-bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>
                                @if ($debt->keterangan == "Lunas")
                                    <span class="badge text-bg-success">Lunas</span>
                                @else
                                    <span class="badge text-bg-danger">Belum Lunas</span>
                                @endif
                            </td>

                            {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                            
                                <td>
                                    {{-- Button Edit --}}
                                    <a href="/hutang/{{ $debt->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
        
                                    @if (auth()->user()->role_id == 1)
                                        {{-- Delete Button --}}
                                        <form action="/hutang/{{ $debt->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            
                        </tr>
                        
                    @endforeach
                    
                    
                </tbody>
            </table>
            {{-- End Table --}}
        </div>
    </div>
    {{-- End Card --}}
</div>

@endsection