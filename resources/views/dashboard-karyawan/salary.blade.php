@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Gaji</h3>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/dashboard/karyawan">Dashboard</a></li>
            <li class="breadcrumb-item active">Gaji</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    
    {{-- Card --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Gaji-Gaji Saya
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
                        <td>{{ date('d-M-Y', strtotime($row->tgl_gajian)); }}</td>
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

            <div class="h6 text-end">Total Keseluruhan Gaji Yang Kamu Terima: @currency($salary)</div>
        </div>
    </div>
    {{-- End Card --}}
</div>


@endsection