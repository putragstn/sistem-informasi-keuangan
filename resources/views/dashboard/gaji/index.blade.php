@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Data Gaji & Jabatan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="/gaji-karyawan">Data Penggajian Karyawan</a></li>
            <li class="breadcrumb-item active">Data Gaji & Jabatan</li>
        </ol>
    </nav>
    {{-- End Breadcumb --}}

    {{-- Button --}}
    <div class="d-flex">
        <a href="/gaji/create" class="btn btn-primary mb-1">Tambah Data Gaji & Jabatan</a>
        {{-- <a href="/gaji-karyawan" class="btn btn-success ms-2 mb-1">Gaji Karyawan</a> --}}
    </div>
    {{-- End Button --}}



    <div class="row">
        <div class="col-lg-12">
            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Gaji & Jabatan
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
                                <th scope="col">Jabatan</th>
                                <th scope="col">Gaji Pokok</th>
                                <th scope="col">Tunjangan Transport</th>
                                <th scope="col">Uang Makan</th>
                                <th scope="col">Total Gaji</th>

                                {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                                @if (auth()->user()->role_id == 1)
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Tunjangan Transport</th>
                            <th scope="col">Uang Makan</th>
                            <th scope="col">Total Gaji</th>

                            {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                            @if (auth()->user()->role_id == 1)
                                    <th scope="col">Action</th>
                            @endif
                        </tfoot>
                        <tbody>

                            @foreach ($salaries as $salary)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $salary->jabatan }}</td>
                                <td>@currency($salary->gaji_pokok)</td>
                                <td>@currency($salary->tj_transport)</td>
                                <td>@currency($salary->uang_makan)</td>
                                <td>@currency($salary->gaji_pokok + $salary->tj_transport + $salary->uang_makan)</td>

                                {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                                @if (auth()->user()->role_id == 1)
                                <td>
                                    {{-- Button Edit --}}
                                    <a href="/gaji/{{ $salary->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                    {{-- Delete Button --}}
                                    <form action="/gaji/{{ $salary->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus gaji ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
            {{-- End Card --}}
        </div>
    </div>

    
</div>

@endsection