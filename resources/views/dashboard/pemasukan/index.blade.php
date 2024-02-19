@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Pemasukan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active">Data Pemasukan</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    

    <div class="d-flex">
        <div class="me-auto pe-1">
            <a href="/data/pemasukan/create" class="btn btn-primary mb-1">Tambah Data Pemasukan</a>
        </div>
        
        <div>
            <a href="/kategori" class="btn btn-info mb-1">Data Sumber</a>

            {{-- <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cetak Semua Data Pemasukan
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <form action="/cetak-laporan/pdf-semua-pemasukan" method="GET">
                            @method('get')
                            <button type="submit" class="btn btn-danger dropdown-item">PDF</button>
                        </form>
                    </li>
                    <li>
                        <form action="/cetak-laporan/print-semua-pemasukan" method="GET">
                            @method('get')
                            <button type="submit" class="btn btn-warning dropdown-item">PRINT</button>
                        </form>
                    </li>
                    <li>
                        <form action="/cetak-laporan/excel-semua-pemasukan" method="GET">
                            @method('get')
                            <button type="submit" class="btn btn-success dropdown-item">EXCEL</button>
                        </form>   
                    </li>
                </ul>
            </div> --}}

            
        </div>
        <div>
            
        </div>
        <div>
            
        </div>
    
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pemasukan
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
                        <th>No</th>
                        <th>Operator</th>
                        <th>Nominal</th>
                        <th>Sumber</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>

                        {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                        @if (auth()->user()->role_id == 1)
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <th>No</th>
                    <th>Operator</th>
                    <th>Nominal</th>
                    <th>Sumber</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>

                    {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                    @if (auth()->user()->role_id == 1)
                        <th>Action</th>
                    @endif
                </tfoot>
                <tbody>
                    
                    @foreach ($incomes as $income)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 
                        <td>
                            {{-- @foreach ($users as $user)
                                @if ($income->user_id == $user->id)
                                    {{ $user->name }}
                                @endif
                            @endforeach --}}
                            {{ $income->user->employee->nama }}
                        </td>

                        
                        <td>@currency($income->nominal)</td>
                        
                        <td>
                            @foreach ($categories as $category)
                            
                            {{-- Tampilin Kategori Sesuai category_id yang lagi di looping --}}
                                @if ($income->category_id == $category->id)
                                    {{ $category->nama_kategori }}
                                @endif
                            @endforeach
                        </td>

                        <td>{{ date('d-M-Y H:i', strtotime($income->tanggal)); }}</td>
                                
                        <td>{{ $income->keterangan }}</td>

                        {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                        @if (auth()->user()->role_id == 1)
                            <td>
                                <a href="/data/pemasukan/{{ $income->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                {{-- <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}

                                {{-- Delete Button --}}
                                <form action="/data/pemasukan/{{ $income->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection