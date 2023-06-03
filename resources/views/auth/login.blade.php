@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<!-- Login Page Start-->
<section class="auth-wrapper">
    <div class="row g-0">
        <div class="hero-static col-lg-4 d-none d-lg-flex flex-column">
            <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                    <a href="/" class="link-fx fw-semibold fs-2 text-white">
                        <img src="{{ asset('assets/frontend/img/logo/logo-white.png') }}" class="img-fluid" width="180" /></a>
                    <p class="me-xl-8 mt-2 text-light">Welcome to your amazing app. Feel free to login and start managing your projects and clients.</p>
                </div>
            </div>
            <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                <p class="fw-medium text-white-50 mb-0"></p>
                <ul class="list list-inline mb-0 py-2">
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Legal</a></li>
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Contact</a></li>
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Terms</a></li>
                </ul>
            </div>
        </div>
        <div class="hero-static col-lg-8 d-flex flex-column bg-light">
            <div class="p-3 w-100 d-lg-none text-center">
                <a href="/" class="link-fx fw-semibold fs-3 text-dark">
                    <img src="{{ asset('assets/frontend/img/logo/logo-black.png') }}" class="img-fluid" width="180" /></a>
            </div>
            <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                    <div class="text-center mb-5">
                        <a href="/" class="">
                            <img src="{{ asset('assets/frontend/img/favicon.png') }}" class="img-fluid d-inline-block" width="50" />
                        </a>
                        <h2 class="fw-bold mb-2">Sign In</h2>
                        <p class="text-muted">Welcome, please login or <a href="/auth/signup" class="">sign up</a> for a new account.</p>
                    </div>
                    <div class="row g-0 justify-content-center">
                        <div class="col-sm-8 col-md-6 col-lg-6 col-xl-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('login') }}" id="loginBtn">
                                @csrf
                                <div class="mb-4 contact-icon-mail">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus/>
                                </div>
                                <div class="mb-4">
                                    <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password"/>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="remember" role="button">
                                        <input id="remember_me" type="checkbox" name="remember" />
                                        <label for="remember_me">Remember Me</label>
                                    </div>
                                    <div class="form-submission">
                                        <button type="submit" class="btn btn-lg tp-btn">
                                            <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> 
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-submission">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted">
                                            <i class="fa fa-fw fa-unlock-alt me-1 opacity-50"></i> 
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    </div>
                                    <div class="form-submission">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-muted">
                                            <i class="fa fa-fw fa-user-plus me-1 opacity-50"></i> 
                                            Create Account
                                        </a>
                                    @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                <p class="fw-medium text-black-50 py-2 mb-0"></p>
                <ul class="list list-inline py-2 mb-0">
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Legal</a></li>
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Contact</a></li>
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Terms</a></li>
                </ul>
            </div>
        </div>
    </div>       
</section>
<!-- Login Page End -->
@endsection