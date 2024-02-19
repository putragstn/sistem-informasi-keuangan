@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Karyawan - Detail Karyawan {{ $employee->nama }}</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/karyawan">Data Karyawan</a></li>
            <li class="breadcrumb-item active">Detail Data Karyawan</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    <div class="row">

        {{-- Data Diri Karyawan --}}
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table pe-1"></i>
                    Informasi Lengkap {{ $employee->nama }}
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
                    </div>

                </div>
            </div>
        </div>
        {{-- End of Data Diri Karyawan --}}

        {{-- Gaji & Hutang Karyawan --}}
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Informasi Gaji & Jabatan {{ $employee->nama }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 fw-bold">Jabatan</div>
                        <div class="col-lg-7 mb-1">: {{ $employee->salary->jabatan }}</div>

                        <div class="col-lg-5 fw-bold">Tunjangan Transport</div>
                        <div class="col-lg-7 mb-1">: @currency($employee->salary->tj_transport)</div>

                        <div class="col-lg-5 fw-bold">Uang Makan</div>
                        <div class="col-lg-7 mb-1">: @currency($employee->salary->uang_makan)</div>

                        <div class="col-lg-5 fw-bold">Gaji Pokok</div>
                        <div class="col-lg-7 mb-1">: @currency($employee->salary->gaji_pokok)</div>

                        <div class="col-lg-5 fw-bold">Total Gaji</div>
                        <div class="col-lg-7 mb-1">: 
                            <span class="badge text-bg-success">@currency($employee->salary->tj_transport + $employee->salary->uang_makan + $employee->salary->gaji_pokok)</span>
                        </div>
                </div>
            </div>
        </div>
        {{-- End of Gaji & Hutang Karyawan --}}
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Keseluruhan Gaji {{ $employee->nama }}
                </div>
                <div class="card-body">

                    {{-- Table --}}
                    <table id="datatablesSimple" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Total Gaji</th>

                            </tr>
                        </thead>
                        <tbody>

                            {{-- @dd($employeeSalary) --}}

                            @php
                                $salary = 0;
                            @endphp
                            @foreach ($employeeSalary as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-M-Y', strtotime($row->tgl_gajian)) }}</td>
                                <td>{{ $row->employee->nama }}</td>
                                <td>{{ $row->salary->jabatan }}</td>
                                <td>@currency($row->salary->gaji_pokok + $row->salary->tj_transport + $row->salary->uang_makan)</td>
                                
                                @php
                                    $salary += $row->salary->gaji_pokok + $row->salary->tj_transport + $row->salary->uang_makan;
                                @endphp
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    {{-- End Table --}}

                    <div class="h6">Total Keseluruhan Gaji Yang {{ $employee->nama }} Terima: </div>
                    <div class="h6">@currency($salary)</div>
                    

                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Keseluruhan Hutang {{ $employee->nama }}
                </div>
                <div class="card-body">
                    {{-- Table --}}
                    <table id="tabelHutang" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah Hutang</th>
                                <th scope="col">Tgl Pinjam</th>
                                <th scope="col">Jatuh Tempo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @dd($employeeDebt) --}}
                            
                            @php
                                $hutangBelumLunas = 0;
                            @endphp
                            @foreach ($employeeDebt as $debt)
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
                                if ($debt->status === 1 && $debt->keterangan == "Belum Lunas") {
                                    $hutangBelumLunas += $debt->jumlah_hutang;
                                }
                            @endphp
                            @endforeach
                            

                            
                            
                        </tbody>
                    </table>
                    {{-- End Table --}}

                    <div class="h6">Total Keseluruhan Hutang {{ $employee->nama }} : </div>
                    <div class="h6">@currency($hutangBelumLunas)</div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection