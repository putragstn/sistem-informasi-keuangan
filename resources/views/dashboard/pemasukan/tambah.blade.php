@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Pemasukan - Tambah Data Pemasukan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/data/pemasukan">Data Pemasukan</a></li>
            <li class="breadcrumb-item active">Tambah Data Pemasukan</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tambah Data Pemasukan
                </div>
                
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/data/pemasukan" method="POST">

                        @method('post')
                        @csrf

                        {{-- Mengambil ID User yang sedang login  --}}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="mb-3 row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nominal" name="nominal" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" id="kategori" name="category_id" required>
                                    <option selected>Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection