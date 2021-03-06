@extends('user.home')
@section('page-title')
    Edit Profile
@endsection

@section('user-home')
    <div class="container">
        <div class="justify-content-center mt-5">
            <div class="row ml-5">
                @if(session()->has('message'))
                    <span class="text-success">{{session()->get('message')}}</span>
                @endif
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{route('user.profile.update',$profile->id)}}">
                @csrf
                <div class="row">
                    <div class="col-md-12 shadow-lg p-5 ml-5 mb-5 bg-white rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Profile Image</h2>
                                <img src="{{asset("$profile->img")}}" class="img-fluid" alt="" width="150px" height="150px">
                                <div class="form-group row mt-5">     
                                        <div class="row">
                                            <input id="img" type="file" class="@error('img') is-invalid @enderror" name="img"/>
                                        </div>
                                        @error('img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                </div>
                                <div class="row mt-2">
                                    <h6 class="">Image Format: <span class="text-danger">jpeg,jpg,png</span> </h6>
                                </div>
                                <div class="row">
                                    <h6>Image Size: <span class="text-danger">At most 1mb</span> </h6>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-left"><h2>Address</h2></label>     
                                    <textarea id="address" 
                                            type="text" 
                                            class="form-control @error('address') is-invalid @enderror" 
                                            name="address" 
                                            
                                            autocomplete="address" 
                                            rows="5"
                                            autofocus>{{ $profile->address }}</textarea>
            
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror         
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-left"><h2>City</h2></label>     
                                <input id="city" 
                                        type="text" 
                                        class="form-control @error('city') is-invalid @enderror" 
                                        name="city" 
                                        value="{{ $profile->city }}"
                                        autocomplete="city" 
                                       
                                        autofocus/>
        
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror         
                        </div>
                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-left"><h2>Zip Code</h2></label>     
                            <input id="zip" 
                                    type="text" 
                                    class="form-control @error('city') is-invalid @enderror" 
                                    name="zip" 
                                    value="{{ $profile->zip }}"
                                    autocomplete="city" 
                                   
                                    autofocus/>
    
                            @error('zip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror         
                    </div>
                    <div class="form-group row">
                        <label for="nid" class="col-md-4 col-form-label text-md-left"><h2>NID</h2></label>     
                        <input id="nid" 
                                type="text" 
                                class="form-control @error('nid') is-invalid @enderror" 
                                name="nid" 
                                value="{{ $profile->nid }}"
                                autocomplete="nid" 
                               
                                autofocus/>
    
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                    </div>
                            </div>
                            <div class="submit-btn text-right">
                                <button type="submit" class="pull-right btn btn-success btn-lg">
                                    Update
                                </button>
                            </div>
                        </div>

                       
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection