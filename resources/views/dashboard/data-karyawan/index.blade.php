@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">Karyawan</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            @if (auth()->user()->role_id == 1)
                <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard/bendahara">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active">Data Karyawan</li>
        </ol>
    </nav>
    {{-- End Breadcumb --}}

    {{-- Button --}}
    <div class="d-flex">
        <a href="/karyawan/create" class="btn btn-primary mb-1">Tambah Data Karyawan</a>
    </div>
    {{-- End Button --}}


    {{-- Card --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Karyawan
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
            <table id="datatablesSimple" class="table-responsive">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        {{-- <th scope="col">Kontak</th> --}}
                        <th scope="col">Tgl Masuk</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    {{-- <th scope="col">Kontak</th> --}}
                    <th scope="col">Tgl Masuk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tfoot>
                <tbody>

                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->nama }}</td>
                        <td>{{ $employee->salary->jabatan }}</td>
                        {{-- <td>
                            @if ($employee->jenis_kelamin == "L" || $employee->jenis_kelamin == "l")
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </td> --}}
                        {{-- <td>{{ $employee->no_telp }}</td> --}}
                        <td>{{ date('d-M-Y', strtotime($employee->tgl_masuk)); }}</td>
                        <td>
                            @if ($employee->status == 1)
                                <span class="badge text-bg-primary">Karyawan Kontrak</span>
                            @elseif($employee->status == 2)
                                <span class="badge text-bg-success">Karyawan Tetap</span>
                            @else
                                <span class="badge text-bg-danger">Tidak Aktif</span>
                            @endif
                        </td>

                        {{-- Jika bukan super admin, maka tidak boleh mengubah dan menghapus --}}
                        @if (auth()->user()->role_id == 1)
                        <td>
                            <a href="/karyawan/{{ $employee->id }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            {{-- Button Edit --}}
                            <a href="/karyawan/{{ $employee->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                            {{-- Delete Button --}}
                            <form action="/karyawan/{{ $employee->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus karyawan ini?')">
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

@endsection