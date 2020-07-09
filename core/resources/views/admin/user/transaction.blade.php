@extends('admin.layouts.app')

@section('user-profile')
<a href=""></a>
<a
href="{{route('admin.user.profile',$user->id)}}" 
class="list-group-item list-group-item-action  {{ Request::is("admin/transaction/$user->id") ? 'active' : '' }}">
    <div class="row">
        <div class="col-md-10">{{$user->name}}</div>
        <div class="col-md-2"><i class="fas fa-search"></i></div>
    </div>
</a> 
@endsection
@section('content')
    <div class="container-fluid">
        
      <h1 class="text-center">User Transaction Log</h1>
      <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
          <div class="row">
          </div>
          <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Transaction ID</th>
                  <th scope="col">User</th>           
                  <th scope="col">Amount</th>
                  <th scope="col">Charge</th>
                  <th scope="col">Current Balance</th>
                  <th scope="col">Remarks</th>
                  <th scope="col">Status</th>
                  <th scope="col">Transaction Date</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($user->master_transactions->sortDesc() as $transaction)
                  <tr>
                      <th scope="row">{{$transaction->trax_id}}</th>
                      <td>
                          <a href="{{route('admin.user.profile',$transaction->user->id)}}" class="text-primary">
                              {{$transaction->user->name}}
                          </a>
                      </td>
                      {{-- <td>
                          <a href="{{route('admin.user.profile',$transaction->receiver->id)}}" class="text-primary">
                              {{$transaction->receiver->name}}
                          </a>
                      </td> --}}
                      <td>
                          @if($transaction->status==0)
                              <div class="row">
                                  <div class="col-md-8">
                                      <span class="text-danger">{{number_format($transaction->amount,2)}} ({{$currency}}) </span>
                                  </div>
                                  <div class="col-md-4">
                                      <span class="ml-3 text-danger"><i class="fas fa-arrow-right"></i></span> 
                                  </div>
                              </div>
                          @else
                              <div class="row">
                                  <div class="col-md-8">
                                      <span class="text-success">{{number_format($transaction->amount,2)}} ({{$currency}}) </span>
                                  </div>
                                  <div class="col-md-4">
                                      <span class="ml-3 text-success"><i class="fas fa-arrow-left"></i></span> 
                                  </div>
                              </div>
                          @endif 
                          
                      </td>
                      <td>{{$transaction->charge}} ({{$currency}})</td>
                      <td>{{$transaction->current_balance}} ({{$currency}})</td>
                      <td> {{$transaction->remarks}} </td>
                      <td>
                          @if($transaction->status==0)
                              <span class="text-danger">DEBITED</span>
                          @else
                              <span class="text-success">CREDITED</span>
                          @endif 
                      </td>
                      
                      <td>{{$transaction->created_at->diffforhumans()}}</td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
         
      </div>
        <div class="row">
          <div class="user-interest-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-primary">
            <h2 class="text-center"><u>Recieve Interest From Wallet System</u></h2>
            <table class="table text-primary text-lg-center">
              <thead class="thead-dark">
                <tr>
                  {{-- <th scope="col">Transaction Id</th> --}}
                  <th scope="col">Previous Balance</th>                      
                  <th scope="col">Interest Rate (%)</th>
                  <th scope="col">Current Balance</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user->interest_transactions->sortByDesc('created_at') as $transaction)
                <tr>
                  {{-- <th scope="row">{{$transaction->id}}</th> --}}
                  {{-- @dd($transaction->sender) --}}
                  <td>{{number_format($transaction->user->wallet->prev_balance)}} {{$currency}}</td>
                  <td>{{$transaction->interest_rate}} {{$currency}}</td>
                  <td>{{number_format($transaction->user->wallet->current_balance)}} {{$currency}}</td>
                  <td>
                    {{$transaction->created_at->diffforhumans()}}
                  </td>
                </tr>
                @endforeach                 
              </tbody>
            </table>
            
          </div>
        </div>

        <div class="row">
          <div class="rcv-bonus-from-my-refe-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-success">
            <h2 class="text-center"><u>Recieve Bonus From <span class="text-uppercase">
              {{$user->name}}'s</span> Refrency Activity</u></h2>
            <table class="table text-primary text-lg-center">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Transaction By</th>                      
                  <th scope="col">Bonus Amount</th>
                  <th scope="col">Status</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                {{-- @dd($user->bonus_from_transactions) --}}
                @foreach ($user->bonus_from_transactions->sortByDesc('created_at') as $transaction)
                <tr>
                  {{-- <th scope="row">{{$transaction->id}}</th> --}}
                  {{-- @dd($transaction->sender) --}}
                  <td>{{$transaction->sender->name}}</td>
                  <td>{{ number_format($transaction->bonus_amount,2) }} {{$currency}}</td>
                  <td>
                    
                      @if($transaction->status == 0)
                        <span class="text-success">On Signup  Bonus </span>
                      @else
                        <span class="text-primary">On Money Send Bonus</span>
                      @endif
                  </td>
                  <td>
                    {{$transaction->created_at->diffforhumans()}}
                  </td>
                </tr>
                @endforeach                 
              </tbody>
            </table>
            
          </div>
        </div>
    </div>
@endsection