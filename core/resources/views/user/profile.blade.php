@extends('user.layouts.app')

@section('content')
    <div class="container-fluid">
      <div class="container">
        @if(session()->has('message'))
          <h4 class="text-center text-success text-large">{{session()->get('message')}}</h4>
        @endif
        @if(session()->has('error'))
          <h4 class="text-center text-danger text-large">{{session()->get('error')}}</h4>
        @endif
      </div>
        <div class="row">
            <div class="col-md-3">
                {{-- @dd($profile) --}}
                <div class="row">
                <div class="col-md-12  card text-center text-justify h-100 shadow-lg p-3 mb-5 bg-white rounded">
                  <div class="mt-1 mb-1">
                    <h2 class="text-info">Details</h2>
                   @php $img=$user->profile->img @endphp
                    <img src="{{asset("$img")}}" class="mx-auto img-thumbnail" width="250px" height="250px" alt="Profile Picture">
                  <div class="card-body">
                    <h5 class="card-title">Name: <span class="font-weight-bold">{{$user->name}}</span></h5>
                    <h5 class="card-title">Username: <span class="font-weight-bold">{{$user->username}}</span></h5>
                    <h5 class="card-title">Email: <span class="font-weight-bold">{{$user->email}}</span></h5>
                    <h5 class="card-title">Referenced By:  <span class="text-uppercase text-success  font-weight-bold">@if($user->referred_by!=null){{$user->referred_by->username}}@endif</span> </h5>
                      <div class="wallet-info mt-2 mb-2">
                        <h2 class="text-info">Wallet Details</h2>
                          <h5 class="card-title">Current Balance: <span class="font-weight-bold">{{number_format($user->wallet->current_balance,2)}} </span> </h5>
                          <h5 class="card-title">Previous Balance: <span class="font-weight-bold">{{number_format($user->wallet->prev_balance,2)}}</span></h5>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-12 h-100 shadow-lg p-3 mb-5 bg-white rounded">
                  <div class="transaction-button">
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{route('user.profile.edit',$user->profile->id)}}" class="btn btn-block btn-md btn-primary text-white text-uppercase">Edit Profile <span class="ml-3"><i class="fas fa-user-edit"></i></span> </a>
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
                        <a href="{{route('user.referto')}}" class="mb-2 mt-2 btn btn-block btn-md btn-info text-white text-uppercase">Referred To User List <span class="ml-3"> <i class="fas fa-retweet"></i>
                          </span> </a>
                        {{-- <a href="{{route('user.sendreflink')}}" class="btn btn-block btn-md btn-success text-white text-uppercase">Send Referral Link</a> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              
              
              <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
                <h1 class="text-center text-primary">Transaction Log</h1>
                  <div class="row">
                  </div>
                  <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Transaction ID</th>
                              
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
                              {{-- <td>
                                  <a href="{{route('admin.user.profile',$transaction->user->id)}}" class="text-primary">
                                      {{$transaction->user->name}}
                                  </a>
                              </td> --}}
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
                              <td>{{ number_format($transaction->current_balance,2) }} ({{$currency}})</td>
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
                      <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <span class="text-primary">Total Transactions: {{$user->master_transactions->count()}}  </span> 
                        </td>
                        <td> <span class="text-success">Total Credited: {{number_format($user->master_transactions->where('status',1)->sum('amount'),2)}}  </span> </td>
                        <td> <span class="text-danger"> Total Debited: {{number_format($user->master_transactions->where('status',0)->sum('amount'),2)}}   </span> </td>
                      </tfoot>
                  </table>
                    {{-- {{$user->links()}} --}}
              </div>

              <div class="user-interest-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-primary">
                <h2 class="text-center">Recieve Interest From Wallet System</h2>
                <table class="table text-primary text-lg-center">
                  <thead class="thead-dark">
                    <tr>
                      {{-- <th scope="col">Transaction Id</th> --}}
                      {{-- <th scope="col">Previous Balance</th>                       --}}
                      <th scope="col">Interest Rate (%)</th>
                      <th scope="col">After Interest Balance</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user->interest_transactions->sortDesc() as $transaction)
                    <tr>
                      {{-- <th scope="row">{{$transaction->id}}</th> --}}
                      {{-- @dd($transaction->sender) --}}
                      {{-- <td>{{number_format($transaction->user->wallet->prev_balance)}} {{$currency}}</td> --}}
                      <td>{{$transaction->interest_rate}}</td>
                      <td>{{number_format($transaction->amount)}} {{$currency}}</td>
                      <td>
                        {{$transaction->created_at->diffforhumans()}}
                      </td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  <tfoot>
                    <td></td>
                    <td>Total Bonus: {{ number_format($user->interest_transactions->sum('amount'),2) }} {{$currency}} </td>
                    <td></td>
                  </tfoot>
                </table>
                
              </div>

              <div class="rcv-bonus-from-my-refe-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-success">
                <h2 class="text-center">Recieve Bonus From My Refrency Activity</h2>
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
                    @foreach ($user->bonus_from_transactions->sortDesc() as $transaction)
                    <tr>
                      {{-- <th scope="row">{{$transaction->id}}</th> --}}
                      {{-- @dd($transaction->sender) --}}
                      <td>{{$transaction->sender->name}}</td>
                      <td>{{$transaction->bonus_amount}} {{$currency}}</td>
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
                  <tfoot>
                    <td></td>
                    <td>
                      Total Bonus: {{$user->bonus_from_transactions->sum('bonus_amount')}} {{$currency}}
                    </td>
                  </tfoot>
                </table>
                
              </div>

            </div>
        </div>
    </div>
@endsection
