@extends('layouts.app')

@section('content')
    <div class="row align-items-center justify-content-center min-vh-100">
        <div class="col-7 d-none d-lg-block">
            <img src="{{ asset('images/bg-signin.png') }}" alt="" class="img-fluid" />
        </div>

        <div class="col-12 col-md-8 col-lg-5">
            <div class="card bg-light sign-in-card shadow">
                <div class="card-body p-5">
                    <h2 class="text-primary mb-4 text-center">Login</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="floatingInput"
                                name="phone" value="{{ old('phone') }}" placeholder="name@example.com" required
                                autofocus />
                            <label for="floatingInput">Phone</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id=" floatingPassword" placeholder="Password" required
                                autocomplete="current-password" />
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="defaultCheck1"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="defaultCheck1">
                                    Remember me
                                </label>
                            </div>

                            <a href="#" class="text-muted small text-decoration-none">Forgot passowrd?</a>
                        </div>

                        <button class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
