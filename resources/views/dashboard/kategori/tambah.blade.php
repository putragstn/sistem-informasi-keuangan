@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori</h1>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>

            <li class="breadcrumb-item">
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="/data/pemasukan">Data Pemasukan</a></li>
                        <li class="dropdown-item"><a href="/data/pengeluaran">Data Pengeluaran</a></li>
                    </ul>
                </div>
            </li>

            <li class="breadcrumb-item"><a href="/kategori">Data Kategori</a></li>
            <li class="breadcrumb-item active">Tambah Data Kategori</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tambah Data Kategori
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="/kategori" method="POST">

                        @method('post')
                        @csrf

                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-4 col-form-label">Nama Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kategori" name="nama_kategori" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jenis_kategori" class="col-sm-4 col-form-label">Jenis Kategori</label>
                            <div class="col-sm-8">
                                <select name="jenis_kategori" id="jenis_kategori" class="form-select">
                                    <option value="Pemasukan">Pemasukan</option>
                                    <option value="Pengeluaran">Pengeluaran</option>
                                </select>
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