@extends('admin.layouts.app')

@section('page-title')
    Settings
@endsection

@section('content')
    <div class="container">
        <div class="error text-center">
            @if(session()->has('st_msg'))
                <span class="text-success">{{session()->get('st_msg')}}</span>
            @endif
        </div>
        <form action="{{route('admin.setting')}}" method="post">
            @csrf 
            <div class="row">
                <h3 class="text-primary">Wallet System Charges </h3>
            </div>
            <div class="row shadow-lg p-5 mb-5 bg-white rounded">               
                <div class="col-md-3">
                    <div class="form-group row">
                        <label for="fixed_charge" class="col-md-4 col-form-label text-md-left"><span>Fixed Charge</span></label>     
                        <input id="fixed_charge" 
                                type="text" 
                                class="form-control @error('fixed_charge') is-invalid @enderror" 
                                name="fixed_charge" 
                                value="{{$settings->fixed_charge}}"
                                autofocus/>
        
                        @error('fixed_charge')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                    </div>
                </div>
                <div class="col-md-4 ml-3">
                    <div class="form-group row">
                        <label for="percent_charge" class="col-md-4 col-form-label text-md-left"><span>Percent Charge (%)</span></label>     
                        <input id="percent_charge" 
                                type="text" 
                                class="form-control @error('percent_charge') is-invalid @enderror" 
                                name="percent_charge" 
                                value="{{$settings->percent_charge}}"
                                autofocus/>
        
                        @error('percent_charge')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
                <div class="col-md-3 ml-3">
                    <div class="form-group row">
                        <label for="interest_rate" class="col-md-4 col-form-label text-md-left"><span> Interest Rate (%)</span></label>     
                        <input id="interest_rate" 
                                type="text" 
                                class="form-control @error('interest_rate') is-invalid @enderror" 
                                name="interest_rate" 
                                value="{{$settings->interest_rate}}"
                                autofocus/>
        
                        @error('interest_rate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
            </div>

            <div class="row mt-5">
                <h3 class="text-primary">User Bonus On Signup</h3>
            </div>
            <div class="row shadow-lg p-5 mb-5 bg-white rounded">
                <div class="col-md-5">
                    <div class="form-group row">
                        <label for="on_signup_bonus" class="col-md-4 col-form-label text-md-left"><span>Change On Signup Bonus</span></label>     
                        <input id="on_signup_bonus" 
                                type="text" 
                                class="form-control @error('on_signup_bonus') is-invalid @enderror" 
                                name="on_signup_bonus" 
                                value="{{$settings->on_signup_bonus}}"
                                autofocus/>
        
                        @error('on_signup_bonus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
            </div>
            <div class="row ">
                <h3 class="text-primary">Reference Get Bonus</h3>
            </div>
            <div class="row shadow-lg p-5 mb-5 bg-white rounded">
                <div class="col">
                    <div class="form-group row">
                        <label for="on_signup_ref_bonus" class="col-md-4 col-form-label text-md-left"><span>On Signup Reference Bonus</span></label>     
                        <input id="on_signup_ref_bonus" 
                                type="text" 
                                class="form-control @error('on_signup_ref_bonus') is-invalid @enderror" 
                                name="on_signup_ref_bonus" 
                                value="{{$settings->on_signup_ref_bonus}}"
                                autofocus/>
        
                        @error('on_signup_ref_bonus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
                <div class="col ml-2">
                    <div class="form-group row">
                        <label for="on_money_send_bonus" class="col-md-4 col-form-label text-md-left"><span>On Money Send Bonus (%) </span></label>     
                        <input id="on_money_send_bonus" 
                                type="text" 
                                class="form-control @error('on_money_send_bonus') is-invalid @enderror" 
                                name="on_money_send_bonus" 
                                value="{{$settings->on_money_send_bonus}}"
                                autofocus/>
        
                        @error('on_money_send_bonus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
            </div>
            <div class="row ">
                <h3 class="text-primary">Currency Settings</h3>
            </div>
            <div class="row shadow-lg p-5 mb-5 bg-white rounded">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="set_currency" class="col-md-4 col-form-label text-md-left"><span>Set Currency </span></label>     
                                <select name="set_currency" id="" class="form-control">
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->currency}}">{{$currency->currency}}</option>
                                    @endforeach
                                </select>
        
                        @error('set_currency')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                </div>
                </div>
                <div class="col-md-4">
                    <label for="">Default Currency: </label>
                    <input class="form-control" type="text" readonly value="{{$settings->set_currency}}">
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success btn-md pull-right">Update</button>
            </div>
        </form>
    </div>
@endsection