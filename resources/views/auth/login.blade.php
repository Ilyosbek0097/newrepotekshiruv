@extends('layouts.login')
@section('title','Log In')

@section('content')

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
            <img src="vendors/images/login-page-img.png" alt="">
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Tizimga Kirish</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group custom">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="email" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                        </div>
                    </div>
                    <div class="input-group custom">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>
                    <div class="row pb-30">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Parolni Saqlash</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="forgot-password"><a href="forgot-password.html">Parolni Unutdingizmi?</a></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group mb-0">
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Kirish">
                                {{--                            <a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a>--}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

