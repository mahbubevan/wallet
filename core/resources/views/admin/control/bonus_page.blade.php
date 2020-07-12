@extends('admin.layouts.app')

@section('page-title')
    Bonus
@endsection

@section('content')
    <div class="contaiiner">
        <h3>Bonus For All User</h3>
       <div class="justify-content-center w-25 mt-4 shadow-lg p-5 mb-5 bg-white">
        <div class="row">
            @if(session()->has('message'))
            <span class="text-success">{{session()->get('message')}}</span>
        @endif
        </div>
        
        <form  method="POST" action="{{route('admin.give.bonus')}}">
            @csrf
            <div class="row">
                <div class="col-md-12 w-50">            
                    <div class="form-group row mt-5">
                    <label for="bonus" class="col-md-6 col-form-label">Current Interest Rate (%)</label>      
                    <input id="bonus" readonly class="form-control w-25" type="text" value="{{$interest_rate}}" class=" @error('bonus') is-invalid @enderror" name="bonus"/>
                            @error('bonus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror         
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-md btn-block btn-primary" type="submit">Give Bonus</button>
                </div>
            </div>
            </form>
       </div>
    </div>
@endsection