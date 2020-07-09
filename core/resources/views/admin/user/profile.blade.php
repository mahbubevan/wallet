@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="justify-content-center shadow-lg pl-5 pt-5 pr-5 pb-5 mb-5 bg-white rounded">
            <h4 class="text-center">
                @if(session()->has('message'))
                    <span class="text-success">{{session()->get('message')}}</span>
                @endif
            </h4>
            <div class="user-name mt-2 mb-5">
                <h1 class="text-primary">{{$profile->user->name}}</h1>
                <a href="{{route('admin.user.transaction',$profile->user->id)}}" class="btn btn-outline-info btn-sm">View Transactions</a>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{route('admin.user.profile',$profile->id)}}">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{asset("$profile->img")}}" class="img-fluid" width="300px" height="300px" alt="">
                        <div class="form-group row mt-5 ml-2">     
                                <input id="img" type="file" class=" @error('img') is-invalid @enderror" name="img"/>
                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror         
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="text-primary"><u>User Information</u></h3>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-left"><h4>Name</h4></label>     
                                        <input id="name" 
                                                type="text" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                name="name" 
                                                value="{{ $profile->user->name }}"
                                                autocomplete="name" 
                                               
                                                autofocus/>
                
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror         
                                </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-left"><h4>Username</h4></label>     
                                        <input id="username" 
                                                type="text" 
                                                class="form-control @error('username') is-invalid @enderror" 
                                                name="username" 
                                                value="{{ $profile->user->username }}"
                                                autocomplete="username" 
                                               
                                                autofocus/>
                
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror         
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-left"><h4>Email</h4></label>     
                                    <input id="email" 
                                            type="text" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            name="email" 
                                            value="{{ $profile->user->email }}"
                                            autocomplete="email" 
                                           
                                            autofocus/>
            
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror         
                            </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-left"><h4>Address</h4></label>     
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
                                    <label for="city" class="col-md-4 col-form-label text-md-left"><h4>City</h4></label>     
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
                                <label for="zip" class="col-md-4 col-form-label text-md-left"><h4>Zip Code</h4></label>     
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
                            <label for="nid" class="col-md-4 col-form-label text-md-left"><h4>NID</h4></label>     
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
                                <div class="col-md-4 ml-5">
                                    <h3 class="text-primary"><u>Wallet Information</u></h3>
                                    <div class="form-group row">
                                        <label for="current_balance" class="col-md-4 col-form-label text-md-left"><h4>Current Balance</h4></label>     
                                        <input id="current_balance" 
                                                type="text" 
                                                class="form-control @error('current_balance') is-invalid @enderror" 
                                                name="current_balance" 
                                                value="{{ $profile->user->wallet->current_balance }}"
                                                autofocus/>
                    
                                        @error('current_balance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror         
                                    </div>
                                    <div class="row">
                                        <h4 class="text-primary">Refered To User's</h4>
                                        <div class="table-responsive">
                                            
                                        <table class="table">
                                            <thead class="thead-dark">
                                              <tr>
                                                
                                                <th scope="col">Name</th>
                                                <th scope="col">View</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($refers as $r)
                                              <tr>
                                                
                                                <td>{{$r->name}}</td>
                                                <td>
                                                    <a href="{{route('admin.user.profile',$r->id)}}" class="btn btn-sm btn-success">View</a>
                                                </td>
                                                @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
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