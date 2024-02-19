@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">
    <h2 class="mt-4">User Management - Ubah Data User</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/users">Data User</a></li>
            <li class="breadcrumb-item active">Ubah User</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}
    
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Form Ubah Data User
                </div>
                <div class="card-body">
                    
                    {{-- Form --}}
                    <form action="/users/{{ $user->id }}" method="POST">
        
                        @method('put')
                        @csrf
        
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <select name="name" class="form-select">
                                        <option value="{{ $user->employee->id }}">{{ $user->employee->nama }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="staticEmail" name="email" value="{{ $user->email }}">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="role" class="col-sm-4 col-form-label">Role User</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example" id="role" name="role_id" required>
                                    @foreach ($roles as $role)

                                        @if ($role->id == $user->role_id)
                                            <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
                                        @else
                                            @if ($user->role_id == 1 && auth()->user()->name == $user->name)
                                                <option value="{{ $role->id }}" disabled>{{ $role->role_name }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endif
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
        
                        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection