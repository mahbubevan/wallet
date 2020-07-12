@extends('user.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mt-5 h-100">                     
                <div class="list-group list-group-flush shadow-lg mt-3 mb-5 bg-white rounded ">
                    <a href="{{route('user.dashboard')}}" class="btn list-group-item list-group-item-action {{ Request::is('user/dashboard') ? 'active' : '' }}">
                        
                      <div class="row">
                        <div class="col-md-10">Dahsboard</div>
                        <div class="col-md-2"><i class="fas fa-columns"></i>
                        </div>
                    </div>
                    </a>
                    <a class="btn list-group-item list-group-item-action {{ Request::is('user/profile') ? 'active' : '' }}"
                        href="{{route('user.profile')}}"
                    >
                        <div class="row">
                            <div class="col-md-10">Profile</div>
                            <div class="col-md-2"><i class="far fa-user"></i></div>
                        </div>
                    </a>
                    <a
                    href="{{route('user.transaction')}}"
                    class="list-group-item list-group-item-action {{ Request::is('user/transaction') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">Transaction Log</div>
                            <div class="col-md-2"><i class="fas fa-money-check-alt"></i></i></div>
                        </div>
                    </a>
                    <a
                    href="{{route('user.send.transaction')}}"  
                    class="list-group-item list-group-item-action  {{ Request::is('user/send_transaction') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">Send Money Log</div>
                            <div class="col-md-2"><i class="far fa-money-bill-alt"></i></div>
                        </div>
                    </a>
                    <a
                    href="{{route('user.rcv.transaction')}}" 
                    class="list-group-item list-group-item-action  {{ Request::is('user/rcv_transaction') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">Receive Money Log</div>
                            <div class="col-md-2"><i class="fas fa-gifts"></i></div>
                        </div>
                    </a>
                    <a
                    href="{{route('user.ref.transaction')}}" 
                    class="list-group-item list-group-item-action  {{ Request::is('user/ref_bonus') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">Referral Bonus Log</div>
                            <div class="col-md-2"><i class="fas fa-gifts"></i></div>
                        </div>
                    </a>

                    <a
                    href="{{route('user.ref.list')}}" 
                    class="list-group-item list-group-item-action  {{ Request::is('user/ref_list') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">Referral Lists</div>
                            <div class="col-md-2"><i class="fas fa-list"></i></div>
                        </div>
                    </a>
                    <a
                    href="{{route('user.admin.transaction')}}" 
                    class="list-group-item list-group-item-action  {{ Request::is('user/admin_transaction') ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-md-10">System Bonus</div>
                            <div class="col-md-2"><i class="fas fa-gifts"></i></div>
                        </div>
                    </a>
                  </div>     
                       <div class="shadow-lg mt-3 mb-5 bg-white rounded ">
                        <a href="{{route('user.sendmoney')}}" class="btn btn-block btn-md btn-success text-white text-uppercase">Send Money <span class="ml-3"><i class="far fa-paper-plane"></i></span> </a>
                        <form action="{{route('user.sendreflink')}}" method="post">
                          @csrf
                          <input type="email" class="form-control mb-2 mt-2" placeholder="someone@email.com" name="email"/>
                          @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          <button type="submit" class="btn btn-block btn-md btn-warning">Send Reffaral Link <span class="ml-3"><i class="fas fa-link"></i></span> </button>
                        </form>
                       </div>                   
            </div>
            <div class="col-md-10">
                @yield('user-home')
            </div>
        </div>
    </div>
@endsection