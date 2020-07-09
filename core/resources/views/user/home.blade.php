@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} Your user name is <a href="{{route('user.profile')}}" class="text-lg text-success">{{auth()->user()->username}}</a>
                    <span>Go to profile to edit username</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
