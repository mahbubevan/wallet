@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Total Users <i class="fas fa-users"></i></h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_user}}</h3>
                  
                  <div class="text-center">
                    <a href="{{route('admin.userlist')}}" class="card-link btn btn-sm btn-outline-success">View All User</a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Total Transaction</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_transaction}}</h3>
                  
                  <div class="text-center">
                    <a href="{{route('admin.transaction')}}" class="btn btn-sm btn-outline-success card-link">View All Transaction</a>
                  </div>
                  
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Total Reference Transaction</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_ref_transaction}}</h3>
                  
                  <div class="text-center">
                    <a href="{{route('admin.ref.transaction')}}" class="btn btn-sm btn-outline-success card-link">View All</a>
                  </div>
                </div>
              </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Interest Given By Admin</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_trans_by_admin}}</h3>
                  
                 <div class="text-center">
                    <a href="{{route('admin.admin.transaction')}}" class="btn btn-sm btn-outline-success card-link">View All</a>
                 </div>
                  
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Available Currency</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_currency}}</h3>
                  
                  <div class="text-center">
                    <a href="{{route('admin.add.currency')}}" class="btn btn-sm btn-outline-success card-link">Add New Currency</a>
                  </div>
                  <div class="text-center mt-1">
                    <a href="{{route('admin.setting')}}" class="btn btn-sm btn-outline-success card-link">Change Default Currency</a>
                  </div>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;height:15rem">
                <div class="card-body">
                  <h5 class="card-title text-center">Available Settings</h5>
                  <h3 class="card-subtitle text-center mb-2 text-muted">{{$total_settings}}</h3>
                  <div class="text-center">
                    <a href="{{route('admin.setting')}}" class="btn btn-sm btn-outline-success card-link">Go To Settings</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
