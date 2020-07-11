@extends('admin.layouts.app')

@section('content')
<div class="contaiiner">
    <h3>Add New Currency</h3>
   <div class="justify-content-center mt-4 w-25 col-md-12 shadow-lg p-5 mb-5 bg-white">
    <div class="row">
        @if(session()->has('message'))
        <span class="text-success">{{session()->get('message')}}</span>
    @endif
    </div>
    
    <form  method="POST" action="{{route('admin.add.currency')}}">
        @csrf
        <div class="row">
            <div class="col-md-12 w-50">            
                <div class="form-group row mt-5">
                <label for="currency" class="col-md-6 col-form-label">Currency Name</label>      
                <input id="currency" class="form-control w-25" type="text" class=" @error('currency') is-invalid @enderror" name="currency"/>
                        @error('currency')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-md btn-block btn-primary" type="submit">Add New</button>
            </div>
        </div>
        </form>
   
   </div>
</div>
@endsection