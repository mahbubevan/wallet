@extends('admin.layouts.app')

@section('page-title')
    Reference Transaction
@endsection

@section('content')
    <h1 class="text-center">User Referral Transaction Log</h1>
    <div class="rcv-bonus-from-my-refe-transaction table-responsive shadow-lg p-3 mb-5 bg-white rounded">
        
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Transaction Id</th>
              <th scope="col">Transaction By</th> 
              <th scope="col">Benefit User</th>                      
              <th scope="col">Bonus Amount</th>
              <th scope="col">Sender's Current Amount</th>
              <th scope="col">Benefit User's Current Amount</th>  
              <th scope="col">Status</th>
              <th scope="col">Date</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($transactions as $transaction)
            <tr>
              @if($transaction->sender)
                {{-- {{$transaction->sender->name}} --}}
                <th scope="row">{{$transaction->trax_id}}</th>
              <td>{{$transaction->sender->name}}</td>
              
              {{-- @dd($transaction->sender) --}}
              
              <td>
                  @if($transaction->benefit_user)
                {{$transaction->benefit_user->name}}
                @else 
                <span class="text-danger">No Referenced</span>
                @endif
              </td>
              <td>{{$transaction->bonus_amount}} ({{$currency ?? ''}})</td>
              <td>{{number_format($transaction->sender->wallet->current_balance,2)}} ({{$currency ?? ''}})</td>
              @if($transaction->benefit_user)
                <td>{{number_format($transaction->benefit_user->wallet->current_balance,2)}} ({{$currency ?? ''}})</td>
                @else
                <td><span class="text-danger">No Referenced</span></td>
              @endif
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
              @else 
                {{-- <span class="text-danger">No Referenced</span> --}}
              @endif
            </tr>
            @endforeach                 
          </tbody>
        </table>
        <div class="text-center">
            {{$transactions->links()}}
        </div>
      </div>
    </div>
@endsection