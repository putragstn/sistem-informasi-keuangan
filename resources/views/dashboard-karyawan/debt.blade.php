@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Hutang</h3>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/dashboard/karyawan">Dashboard</a></li>
            <li class="breadcrumb-item active">Hutang</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    {{-- Card --}}
    <div class="row">
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Pinjam Hutang
                </div>
                <div class="card-body">
        
                    {{-- Here --}}
                    <form action="/dashboard/karyawan/hutang" method="POST">
                        @csrf
                        @method('post')

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="{{ auth()->user()->employee->nama }}">
                            </div>
                        </div>
    
                        <div class="mb-3 row">
                            <label for="jumlah_hutang" class="col-sm-4 col-form-label">Jumlah Hutang</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="jumlah_hutang" name="jumlah_hutang" required>
                            </div>
                        </div>
    
                        <div class="mb-3 row">
                            <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="alasan" name="alasan">
                            </div>
                        </div>
    
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3">Ajukan Pinjaman</button>
                        </div>

                    </form>
        
                </div>
            </div>
        </div>
    </div>
    {{-- End Card --}}

    
    {{-- Card --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Hutang-Hutang Saya
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
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Hutang</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Tgl Jatuh Tempo</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        // inisialisasi
                        $totalHutang = 0;
                        $hutangBelumLunas = 0;
                    @endphp
                    @foreach ($employeeDebts as $debt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $debt->employee->nama }}</td>
                        <td>@currency($debt->jumlah_hutang)</td>
                        <td>{{ date('d/m/Y', strtotime($debt->tgl_pinjam)) }}</td>
                        <td>
                            @if ($debt->tgl_jatuh_tempo == NULL)
                                -
                            @else
                                {{-- Jika Tgl Jatuh Tempo Sudah Lewat dengan tanggal sekarang --}}
                                @if ($debt->tgl_jatuh_tempo <= date('Y-m-d'))
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
                    </tr>

                    {{-- Jika statusnya diterima & keterangannya belum lunas --}}
                    {{-- maka hitung hutang yg belum lunas --}}
                    @php
                        $totalHutang += $debt->jumlah_hutang;

                        if ($debt->status === 1 && $debt->keterangan == "Belum Lunas") {
                            $hutangBelumLunas += $debt->jumlah_hutang;
                        }
                    @endphp
                    
                    @endforeach

                </tbody>
            </table>
            {{-- End Table --}}

            <div class="h6">Total Hutang Yang Pernah Diajukan: @currency($totalHutang)</div>
            <div class="h6">Total Hutang Belum Lunas: @currency($hutangBelumLunas)</div>

        </div>
    </div>
    {{-- End Card --}}
</div>


@endsection