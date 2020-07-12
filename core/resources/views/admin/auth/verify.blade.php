@extends('admin.layouts.app')

@section('page-title')
    Password Verify
@endsection

@section('content')
<div class="container">
    <div class="mt-30" style="margin-top:15%">
     <div class="row">
         <div class="col-md-12">
          <div class="card shadow-lg p-5 bg-white rounded w-50 m-auto">
            @if(session()->has('message'))
            <span class="text-success">{{session()->get('message')}}</span>
         @endif
        <div class="text-center"><h3 class="text-primary">{{ __('Verify Your Email Address') }} <span><i class="fas fa-envelope-open-text"></i></span></h3></div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <form class="d-inline" method="POST" action="{{route('admin.token.verify')}}">
                @csrf
                <input hidden class="form-control " name="email" value="{{$email}}" required">
                
                <div class="form-group row">
                    <label for="verification_code" class="col-md-3 col-form-label text-md-left">{{ __('Token') }} <span class="ml-2"><i class="fas fa-envelope"></i></span> </label>

                    <div class="col-md-9">
                        <input class="form-control " name="verification_code" required">
                    </div>
                </div>

                <div class="form-group row mb-0 mt-5">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-success btn-block">Verify</button>.
                    </div>
                </div>
            </form>


            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
            </div>
         </div>
     </div>
    </div>
 </div>
@endsection
