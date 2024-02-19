@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h3 class="mt-4">Change Password</h3>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/dashboard/karyawan">Dashboard</a></li>
            <li class="breadcrumb-item active">Change Password</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    {{-- Card --}}
    <div class="row">
        <div class="col-lg-5">

            {{-- Alert / Notifikasi --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Change Password
                </div>
                <div class="card-body">
        
                    {{-- Here --}}
                    <form action="/dashboard/karyawan/change-password" method="POST">
                        @csrf
                        @method('post')

                        <div class="mb-3 row">
                            <label for="oldPasswordInput" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="oldPasswordInput" name="old_password">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="newPasswordInput" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="newPasswordInput" name="new_password">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="confirmNewPasswordInput" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirmNewPasswordInput" name="new_password_confirmation">
                            </div>
                        </div>
    
    
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                        </div>

                    </form>
        
                </div>
            </div>
        </div>
    </div>
    {{-- End Card --}}

    
</div>


@endsection