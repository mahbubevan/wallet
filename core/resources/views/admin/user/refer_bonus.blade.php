@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="rcv-bonus-from-my-refe-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-success">
        <div class="mt-2 ml-2">
            <h5>User Name: <a href="{{route('admin.user.profile',$id)}}" class="text-primary text-uppercase">
              {{$transactions->first()->benefit_user->username}}
          </a></h5>
          </div>
      <h2 class="text-center"><u>Referral Bonus</u></h2>
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
          @foreach ($transactions as $transaction)
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
@endsection