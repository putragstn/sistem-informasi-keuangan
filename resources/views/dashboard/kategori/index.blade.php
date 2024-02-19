@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori</h1>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif

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

            <li class="breadcrumb-item active">Data Kategori</li>
        </ol>
    </nav>


    <a href="/kategori/create" class="btn btn-primary mb-1">Tambah Data Kategori</a>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Kategori
        </div>
        <div class="card-body">

            {{-- Alert / Notifikasi --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jenis Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Jenis Kategori</th>
                    <th scope="col">Action</th> 
                </tfoot>
                <tbody>
                    
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 

                        
                        <td>{{ $category->nama_kategori }}</td>
                        <td>{{ $category->jenis_kategori }}</td>
                        <td>
                            {{-- Button Edit --}}
                            <a href="/kategori/{{ $category->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                            {{-- Delete Button --}}
                            <form action="/kategori/{{ $category->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection