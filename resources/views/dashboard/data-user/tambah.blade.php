@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">User Management - Tambah Data User</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/users">Data User</a></li>
            <li class="breadcrumb-item active">Tambah User</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}
    
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Tambah Data User
                </div>
                <div class="card-body">
                    
                    {{-- Form --}}
                    <form action="/users" method="POST">
        
                        @method('post')
                        @csrf

                        <input type="hidden" name="role_id" value="2">
        
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                                <select name="employee_id" id="name" class="form-select">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="staticEmail" name="email">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="off">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="role" class="col-sm-4 col-form-label">Role User</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="role" name="role_id" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label for="isActive" class="col-sm-4 col-form-label">Is Active</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('is_active') is-invalid @enderror" id="isActive" name="is_active">

                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
        
                        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection