@extends('auth.layouts.main')

@section('container')

<div class="row text-center justify-content-center">
    <div class="col-lg-6">

        <main class="form-signin w-100 m-auto">

            {{-- Pesan Flash Data Jika Berhasil Register --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- <div class="text-center" style="margin-bottom: -70px">
                <img class="mb-4" src="{{ URL::asset('img/transparan-logo-name.png') }}" alt="icons" width="200" height="200">
            </div> --}}

            <h1 class="h3 fw-normal mb-5">CV. CAHAYA BINTANG</h1>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/" method="POST">

                {{-- Security Form --}}
                @csrf
                
                
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>

            <div class="text-center">
                {{-- <a href="/register" class="mt-3 d-block">Register</a> --}}
                <p class="mt-5 mb-3 text-body-secondary">Copyright &copy; CV. Cahaya Bintang {{ date('Y') }}</p>
            </div>
        </main>

    </div>
</div>

@endsection
    