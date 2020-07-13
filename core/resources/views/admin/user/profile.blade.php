@extends('admin.layouts.app')
@section('page-title')
    User Profile
@endsection

@section('content')
   <div class="container-fluid">
       <div class="justify-content-center">
         <h3 class="text-center text-uppercase"> {{$profile->user->name}} </h3>
            <div class="row mt-5">
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded ">
                        <div class="card-body">
                          <h5 class="card-title text-center">Current Balance</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class=""> {{ number_format($current_balance,2) }} ({{$currency}}) </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.transaction',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title text-center">Total Send Balance</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class="">  {{$total_send_balance}} ({{$currency}})  </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.send.transaction',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title text-center">Total Receive Balance</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class=""> {{$total_rcv_balance}} ({{$currency}})  </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.rcv.transaction',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title text-center">Bonus By Admin</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class=""> {{number_format($bonus,2)}}  ({{$currency}}) </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.admin.transaction',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title text-center">Total Referral User</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class=""> {{$total_ref_user}} </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.ref.list',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title text-center">Total Referral Bonus</h5>
                          <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                          
                          <div class="text-center mt-5">
                            <h5 class=""> {{$total_ref_bonus}} ({{$currency}})  </h5>
                          </div>
                          <div class="text-center mt-3">
                            <a href="{{route('admin.user.ref.transaction',$profile->user->id)}}" class="btn btn-md btn-outline-success card-link">View</a>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                  <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                      <div class="card-body">
                        <h5 class="card-title text-center">Add Balance <span class="ml-2 text-primary">(<i class="fas fa-plus"></i>)</span> </h5>
                        <h3 class="card-subtitle text-center mb-2 text-muted"></h3>

                        <form action="{{route('admin.user.add.balance')}}" method="post">
                          @csrf
                          <div class="text-center mt-5">
                            <input type="hidden" name="user" value="{{$profile->user->id}}" class="form-control w-50 offset-3">
                            <input type="text" name="amount" class="form-control w-50 offset-3">
                          </div>
                          <div class="text-center mt-3">
                            <button type="submit" class="btn btn-md btn-outline-primary">Add</button>
                          </div>
                        </form>
                      </div>
                    </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                      <h5 class="card-title text-center">Substract Balance <span class="ml-2 text-danger">(<i class="fas fa-minus"></i>)</span></h5>
                      <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                      
                      <div class="text-center mt-5">
                         
                        <form action="{{route('admin.user.sub.balance')}}" method="post">
                          @csrf
                          <div class="text-center mt-5">
                            <input type="hidden" name="user" value="{{$profile->user->id}}" class="form-control w-50 offset-3">
                            <input type="text" name="amount" class="form-control w-50 offset-3">
                          </div>
                          <div class="text-center mt-3">
                            <button type="submit" class="btn btn-md btn-outline-primary">Substract</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
       </div>

       <div class="shadow-lg mb-5 bg-white rounded ">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.user.profile',$profile->id)}}">
            @csrf
            <div class="row p-4">
                <div class="mx-auto">
                    <img src="{{asset("$profile->img")}}" class="img-fluid img-thumbnail  w-75" alt="">
                    <div class="mt-5">
                        <input id="img" type="file" class=" @error('img') is-invalid @enderror" name="img"/>
                        @error('img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror       
                    </div>
                </div>
               </div>
           <div class="row p-5">
               <div class="col-md-6 offset-3">
                <div class="form-group row mr-1">
                    <label for="name" class="col-md-4 col-form-label text-md-left"><h4>Name</h4></label>     
                    <input id="name" 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            value="{{ $profile->user->name }}"
                            autocomplete="name" 
                           
                          />

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror         
                </div>
                <div class="form-group row mr-1">
                    <label for="username" class="col-md-4 col-form-label text-md-left"><h4>Username</h4></label>     
                    <input id="username" 
                            type="text" 
                            class="form-control @error('username') is-invalid @enderror" 
                            name="username" 
                            value="{{ $profile->user->username }}"
                            autocomplete="username" 
                           
                           />

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror         
            </div>
            <div class="form-group row mr-1">
                <label for="email" class="col-md-4 col-form-label text-md-left"><h4>Email</h4></label>     
                <input id="email" 
                        type="text" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ $profile->user->email }}"
                        autocomplete="email" 
                       
                        />

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
                            >{{ $profile->address }}</textarea>

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
                            
                               />

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                    </div>
                    <div class="form-group row ">
                        <label for="zip" class="col-md-4 col-form-label text-md-left"><h4>Zip Code</h4></label>     
                        <input id="zip" 
                                type="text" 
                                class="form-control @error('city') is-invalid @enderror" 
                                name="zip" 
                                value="{{ $profile->zip }}"
                                autocomplete="city" 
                            
                               />

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
                               />

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror         
                    </div>

        
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Update
                        </button>
           

               </div>
           </div>
         
        </form>
       </div>
   </div>
@endsection