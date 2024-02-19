@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    {{-- {{ dd($date) }} --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pemasukan Harian</h6>
                    <h3>@currency($sumDailyIncome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="/data/pemasukan">Lihat Selengkapnya</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pemasukan Mingguan</h6>
                    <h3>@currency($sumWeeklyIncome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="/data/pemasukan">Lihat Selengkapnya</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pemasukan Bulanan</h6>
                    <h3>@currency($sumMonthlyIncome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Total Keseluruhan Pemasukan</h6>
                    <h3>@currency($totalIncome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pengeluaran Harian</h6>
                    <h3>@currency($sumDailyOutcome)</h3>
                    {{-- <h3>Rp. 100.000.000</h3> --}}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="/data/pengeluaran">Lihat Selengkapnya</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pengeluaran Mingguan</h6>
                    <h3>@currency($sumWeeklyOutcome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="/data/pengeluaran">Lihat Selengkapnya</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pengeluaran Bulanan</h6>
                    <h3>@currency($sumMonthlyOutcome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white py-2 mb-4">
                <div class="card-body">
                    <h6>Total Keseluruhan Pengeluaran</h6>
                    <h3>@currency($totalOutcome)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Jumlah Penghutang</h6>
                    <h3>{{ $totalPeminjam }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        @if (auth()->user()->role_id == 1)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white py-3 mb-4">
                    <div class="card-body">
                        <h6>Jumlah User</h6>
                        <h3>{{ $totalUser }}</h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-3 col-md-6">
            </div>
        @endif

        @if (auth()->user()->role_id == 1)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white py-3 mb-4">
                    <div class="card-body">
                        <h6>Jumlah Karyawan</h6>
                        <h3>{{ $jumlahKaryawan }}</h3>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-3 col-md-6">
            </div>
        @endif
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white py-3 mb-4">
                <div class="card-body">
                    <h6>Pendapatan Bersih</h6>
                    <h3>@currency($pendapatanBersih)</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>


    </div>
    {{-- <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Bulanan
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Tahunan
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div> --}}
</div>

@endsection