@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="mt-30" style="margin-top:15%">
     <div class="row">
         <div class="col-md-12">
          <div class="card shadow-lg p-5 bg-white rounded w-50 m-auto">
            <div class="text-center"> <h3 class="text-primary">{{ __('Reset User Password') }} <span class="ml-2"><i class="fas fa-street-view"></i></span></h3> </div>
            @if(session()->has('message'))
                <span class="text-danger text-center">{{session()->get('message')}}</span>
            @endif
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-5 col-form-label text-md-left">{{ __('E-Mail Address') }} <span class="ml-2"><i class="fas fa-envelope"></i></span> </label>

                        <div class="col-md-7">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block">
                                {{ __('Send Password Reset Token') }} <span><i class="fas fa-paper-plane"></i></span>
                            </button>
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
