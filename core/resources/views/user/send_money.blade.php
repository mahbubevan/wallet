@extends('user.layouts.app')

@section('content')
    <div class="container w-75">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="text-info">Fill Information</h3>
                    <form action="{{ route('user.sendmoney.store') }}" method="POST">
                        @csrf
                    <div class="row w-75">
                        <div class="col-md-12 shadow-lg p-5 mb-5 bg-white rounded">
                            @if(session()->has('message'))
                                <span class="text-danger">{{session()->get('message')}}</span>
                            @endif
                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-left">Username (Must Be Valid)</label>     
                                <input id="user" 
                                        type="text" 
                                        class="w-50 form-control @error('user') is-invalid @enderror" 
                                        name="user"
                                        value="{{$username?? ''}}"                
                                        autofocus 
                                        
                                        />
                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror         
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-left">Amount</label>     
                            <input id="amount" 
                                    type="text" 
                                    class="w-50 form-control @error('amount') is-invalid @enderror" 
                                    name="amount" 
                                    
                                    /> {{$currency ?? ''}}
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror         
                            </div>
                            <button type="submit" class="btn btn-block btn-success btn-lg text-uppercase">Send Money <span class="ml-3"><i class="far fa-paper-plane"></i></span></button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
@endsection