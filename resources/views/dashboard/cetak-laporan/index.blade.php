@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">

    <h2 class="mt-4">Cetak Laporan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active">Cetak Laporan</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    <div class="row">

        {{-- ------------------------ --}}
        {{-- CETAK LAPORAN PEMASUKAN  --}}
        {{-- ------------------------ --}}
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <i class="fas fa-table me-1"></i>
                    <h6 class="d-inline">Cetak Laporan Pemasukan</h6>
                </div>

                <div class="card-body">

                    {{-- FORM PRINT --}}
                    <form action="/cetak-laporan/print-income" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-3">PRINT</button>
                        </div>
                    </form>

                    {{-- FORM PDF --}}
                    <form action="/cetak-laporan/pdf-income" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-4">PDF</button>
                        </div>
                    </form>

                    {{-- FORM EXCEL --}}
                    <form action="/cetak-laporan/excel-income" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">EXCEL</button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>

        {{-- -------------------------- --}}
        {{-- CETAK LAPORAN PENGELUARAN  --}}
        {{-- -------------------------- --}}
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <i class="fas fa-table me-1"></i>
                    <h6 class="d-inline">Cetak Laporan Pengeluaran</h6>
                </div>

                <div class="card-body">

                    {{-- FORM PRINT --}}
                    <form action="/cetak-laporan/print-outcome" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-3">PRINT</button>
                        </div>
                    </form>

                    {{-- FORM PDF --}}
                    <form action="/cetak-laporan/pdf-outcome" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-4">PDF</button>
                        </div>
                    </form>

                    {{-- FORM EXCEL --}}
                    <form action="/cetak-laporan/excel-outcome" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">EXCEL</button>
                        </div>
                    </form>
        
                        
                </div>
            </div>
        </div>


        {{-- -------------------- --}}
        {{-- CETAK LAPORAN HUTANG --}}
        {{-- -------------------- --}}
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <i class="fas fa-table me-1"></i>
                    <h6 class="d-inline">Cetak Laporan Hutang</h6>
                </div>

                <div class="card-body">

                    {{-- FORM PRINT --}}
                    <form action="/cetak-laporan/print-hutang" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-3">PRINT</button>
                        </div>
                    </form>

                    {{-- FORM PDF --}}
                    <form action="/cetak-laporan/pdf-hutang" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-4">PDF</button>
                        </div>
                    </form>

                    {{-- FORM EXCEL --}}
                    <form action="/cetak-laporan/excel-hutang" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">EXCEL</button>
                        </div>
                    </form>
        
                        
                </div>
            </div>
        </div>

        {{-- ---------------------------- --}}
        {{-- CETAK LAPORAN GAJI KARYAWAN --}}
        {{-- --------------------------- --}}
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <i class="fas fa-table me-1"></i>
                    <h6 class="d-inline">Cetak Laporan Gaji Karyawan</h6>
                </div>

                <div class="card-body">

                    {{-- FORM PRINT --}}
                    <form action="/cetak-laporan/print-gaji-karyawan" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-3">PRINT</button>
                        </div>
                    </form>

                    {{-- FORM PDF --}}
                    <form action="/cetak-laporan/pdf-gaji-karyawan" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3 px-4">PDF</button>
                        </div>
                    </form>

                    {{-- FORM EXCEL --}}
                    <form action="/cetak-laporan/excel-gaji-karyawan" method="GET" class="row g-3">
                        @method('get')

                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAwal" required>
                        </div>
                        <div class="col-auto">
                            <label class="col-form-label">-</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tglAkhir" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">EXCEL</button>
                        </div>
                    </form>
        
                        
                </div>
            </div>
        </div>


    </div>

    
</div>

@endsection