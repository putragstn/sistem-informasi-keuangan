@extends('auth.layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-6">

        <main class="form-signin w-100 m-auto">

            <div class="text-center">
                <img class="mb-4" src="{{ URL::asset('img/bootstrap-logo.svg') }}" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
            </div>

            <form action="/register" method="POST">

                {{-- Security Form --}}
                @csrf

                
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="Name" name="name" value="{{ old('name') }}">
                    <label for="floatingInput">Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Email" name="email" value="{{ old('email') }}">
                    <label for="floatingInput">Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingInput" name="password" placeholder="Password">
                    <label for="floatingInput">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
            </form>

            <div class="text-center">
                <a href="/" class="mt-3 d-block">Login</a>
                <p class="mt-3 mb-3 text-body-secondary">&copy; {{ date('Y') }}</p>
            </div>
        </main>

    </div>
</div>

@endsection
    