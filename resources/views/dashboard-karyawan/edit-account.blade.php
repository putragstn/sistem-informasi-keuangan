@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Edit Biodata</h3>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/dashboard/karyawan">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/karyawan/profile">My Profile</a></li>
            <li class="breadcrumb-item active">Edit Biodata</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    <div class="row">

        <div class="col-lg-8">

            {{-- Card --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ubah Informasi Akun
                </div>

                <div class="card-body">
                    {{-- Form --}}
                    {{-- Here --}}
                    <form action="/dashboard/karyawan/profile/edit-account/{{ auth()->user()->employee->id }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="{{ auth()->user()->employee->nama }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="role" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="role" name="role" disabled value="{{ auth()->user()->role->role_name }}">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                        </div>

                    </form>
                </div>
                
            </div>
            {{-- End Card --}}

        </div>

    </div>
</div>


@endsection