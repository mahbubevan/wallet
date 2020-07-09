@extends('user.layouts.app')
@section('body-color')
    class="bg-success"
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top:8%">
        <div class="col-md-12">
            <div class="card shadow-lg p-5 bg-white rounded w-75 m-auto">
                <div class="text-center text-success"><h3>{{ __('Registration') }} <span class="ml-3"><i class="fas fa-user-plus"></i></span> </h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="shadow-lg mb-5 bg-white rounded form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if($username !=null)
                        <div class="form-group row">
                            <label for="reference_by" class="col-md-4 col-form-label text-md-right">{{ __('Reference By') }}</label>

                            {{-- @dd($username) --}}
                            <div class="col-md-6">
                                <input id="reference_by"
                                        
                                        type="text"
                                        class="shadow-lg mb-5 bg-white rounded form-control
                                        @error('reference_by') is-invalid @enderror"
                                        name="reference_by"
                                        value="{{$username??''}}"

                                        autocomplete="reference_by"
                                        autofocus>
                                        @if(session()->has('no_ref'))
                                        <span class="text-danger">{{session()->get('no_ref')}}</span>
                                    @endif
                                @error('reference_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($errors->any())
                                    <h4>{{$errors->first()}}</h4>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="mb-5 shadow-lg bg-white rounded form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="mb-5 shadow-lg bg-white rounded form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="mb-5 col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="shadow-lg bg-white rounded form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-md btn-success">
                                    {{ __('Register') }} <span class="ml-2"><i class="fas fa-sign-in-alt"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
