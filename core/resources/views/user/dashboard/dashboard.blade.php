@extends('user.home')

@section('user-home')
<div class="container">
    <h5 class="mt-5">
        Wallet Information
    </h5>
    <div class="row mt-3">      
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-body">
                  <h5 class="card-title text-center">Current Balance</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted"></h3>          
                  <div class="text-center mt-5">
                    <h5 class=""> {{number_format($current_balance,2)}} ({{$currency}}) </h5>
                  </div>
                  <div class="text-center mt-3">
                    <a href="{{route('user.transaction')}}" class="btn btn-md btn-outline-success card-link">View</a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                <div class="card-body">
                  <h5 class="card-title text-center">Total Money Send</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                  
                  <div class="text-center mt-5">
                    <h5 class=""> {{number_format($total_send_balance,2)}} ({{$currency}}) </h5>
                  </div>
                  <div class="text-center mt-3">
                    <a href="{{route('user.send.transaction')}}" class="btn btn-md btn-outline-success card-link">View</a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                <div class="card-body">
                  <h5 class="card-title text-center">Total Money Receive</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                  
                  <div class="text-center mt-5">
                    <h5 class=""> {{number_format($total_rcv_balance,2)}} ({{$currency}}) </h5>
                  </div>
                  <div class="text-center mt-3">
                    <a href="{{route('user.rcv.transaction')}}" class="btn btn-md btn-outline-success card-link">View</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <h5 >
      Transaction Information
    </h5>
  <div class="row mt-3">
     
      <div class="col">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
              <div class="card-body">
                <h5 class="card-title text-center">Total Transactions</h5>
                <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                
                 
                <div class="text-center mt-5">
                  <h5 class=""> {{$transacttion_count}} </h5>
                </div>
              </div>
            </div>
      </div>
      <div class="col">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
              <div class="card-body">
                <h5 class="card-title text-center">Total Send Money Transactions</h5>
                <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                
                <div class="text-center mt-5">
                  <h5 class=""> {{$total_send_money}} </h5>
                </div>
                
              </div>
            </div>
      </div>
      <div class="col">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
              <div class="card-body">
                <h5 class="card-title text-center">Total Receive Money Transactions</h5>
                <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                
                <div class="text-center mt-5">
                  <h5 class=""> {{$total_rcv_money}} </h5>
                </div>
              </div>
            </div>
      </div>
  </div>
    <h5>
        Referral Information
    </h5>
    <div class="row mt-3">
        
        <div class="col-md-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                <div class="card-body">
                  <h5 class="card-title text-center">Total Referral User</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                  
                  <div class="text-center mt-5">
                    <h5 class=""> {{$total_referral_user}} </h5>
                  </div>
                  <div class="text-center mt-3">
                    <a href="{{route('user.ref.list')}}" class="btn btn-md btn-outline-success card-link">View</a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                <div class="card-body">
                  <h5 class="card-title text-center">Total Reffaral Bonus</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                  
                   
                  <div class="text-center mt-5">
                    <h5 class=""> {{ number_format($total_referral_bonus,2) }}  ({{$currency}}) </h5>
                  </div>
                  <div class="text-center mt-3">
                    <a href="{{route('user.ref.transaction')}}" class="btn btn-md btn-outline-success card-link">View</a>
                  </div>
                </div>
              </div>
        </div>
      </div>
    
    <h5 >
      Bonus From System
    </h5>
  <div class="row mt-3">
     
      <div class="col-md-4">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
              <div class="card-body">
                <h5 class="card-title text-center">Total Bonus Transactions</h5>
                <h3 class="card-subtitle text-center mb-2 text-muted"></h3>                 
                <div class="text-center mt-2">
                  <h5 class=""> {{$total_sys_bonus}} </h5>
                </div>
                <div class="text-center mt-3">
                  <a href="{{route('user.admin.transaction')}}" class="btn btn-md btn-outline-success card-link">View</a>
                </div>
              </div>
            </div>
      </div>
      <div class="col-md-4">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
              <div class="card-body">
                <h5 class="card-title text-center">Total Bonus Amount</h5>
                <h3 class="card-subtitle text-center mb-2 text-muted"></h3>
                
                <div class="text-center mt-5">
                  <h5 class=""> {{ number_format($total_sys_balance,2) }} ({{$currency}}) </h5>
                </div>     
              </div>
            </div>
      </div>
  </div>
   
</div>
@endsection