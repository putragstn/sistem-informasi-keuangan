@extends('layouts.main')

@section('container')

<div class="container-fluid px-4">

    <h2 class="mt-4">User Management</h2>

    {{-- Breadcrumb --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="/dashboard/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Data User</li>
        </ol>
    </nav>
    {{-- End Breadcrumb --}}

    {{-- Button --}}
    <a href="/users/create" class="btn btn-primary mb-2">Tambah User</a>
    {{-- End Button --}}

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data User
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role User</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->employee->nama }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            @foreach ($roles as $role)
                                @if ($user->role_id == $role->id)
                                    {{ $role->role_name }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                        {{-- Jika Role Usernya Admin dan sedang login, maka Kosongin --}}
                        {{-- auth()->user->name : untuk mengambil nama user yg sedang login --}}
                        {{-- lalu akan dicocokan dengan user yang usernamenya sama  --}}
                            @if ($user->role_id == 1 && auth()->user()->employee->nama == $user->employee->nama)
                                
                            @else

                                {{-- Delete Button --}}
                                <form action="/users/{{ $user->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection