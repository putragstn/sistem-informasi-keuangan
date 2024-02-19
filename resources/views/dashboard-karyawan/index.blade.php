@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Dashboard Karyawan</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <h1 class="mt-4 mb-3">Selamat Datang, {{ auth()->user()->employee->nama }}</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Jabatan Kamu Saat Ini</h6>
                    <h3>{{ $employee->salary->jabatan }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="/data/pemasukan">Lihat Selengkapnya</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
                </div>
            </div>
        </div>

        {{-- Card Hutang --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white py-3 mb-4">
                <div class="card-body">

                    {{-- Jika statusnya diterima & keterangannya belum lunas --}}
                    {{-- maka hitung hutang yg belum lunas --}}
                    @php
                        $hutangBelumLunas = 0;
                        foreach ($employeeDebts as $debt) {

                            if ($debt->status === 1 && $debt->keterangan == "Belum Lunas") {
                                $hutangBelumLunas += $debt->jumlah_hutang;
                            }
                        }

                    @endphp

                    <h6>Hutang Kamu Saat Ini</h6>
                    <h3>@currency($hutangBelumLunas)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/dashboard/karyawan/hutang">Lihat Hutang</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        {{-- End of Card Hutang --}}
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Gaji Kamu Saat Ini</h6>
                    <h3>@currency($employee->salary->gaji_pokok + $employee->salary->tj_transport + $employee->salary->uang_makan)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/dashboard/karyawan/gaji">Lihat Gaji</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- @dd($employeeSalary) --}}

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Total Gaji Yang Diterima</h6>
                    <h3>
                        @php
                            $total = 0;
                            foreach ($employeeSalary as $row) {
                                $salary = $row->salary->gaji_pokok + $row->salary->tj_transport + $row->salary->uang_makan;
                                $total+= $salary;
                            }
                            // echo $total;
                        @endphp
                        @currency($total)
                    </h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/dashboard/karyawan/gaji">Lihat Gaji</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection