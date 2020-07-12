@extends('user.layouts.app')
@section('body-color')
    class="bg-primary"
@endsection
@section('page-title')
    User Login
@endsection
@section('content')
<div class="container">
   <div class="mt-30" style="margin-top:15%">
    <div class="row">
        <div class="col-md-12">
         <div class="card shadow-lg p-5 bg-white rounded w-50 m-auto">
            <div class="text-lg-center"> <h3 class="text-primary">User Login <span><i class="fas fa-users"></i></span></h3> </div>
            @if(session()->has('message'))
                <span class="text-success">{{session()->get('message')}}</span>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('user.login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }} <span class="ml-2"><i class="far fa-user"></i></span> </label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="shadow p-3 mb-4 bg-white rounded form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span class="ml-2">
                            <i class="fas fa-passport"></i>    
                        </span> </label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="shadow p-3 mb-5 bg-white rounded form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-1">
                            <button type="submit" class="btn btn-success btn-md">
                                {{ __('Login') }} <i class="fas fa-sign-in-alt"></i>
                            </button>

                            @if (Route::has('user.password.request'))
                                <a class="btn btn-link" href="{{ route('user.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </div>
   </div>
</div>
@endsection