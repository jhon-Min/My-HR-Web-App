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
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" />
                            <label for="floatingInput">Email address</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" />
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
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
