@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="user-interest-transaction table-responsive mt-5 mb-5 shadow-lg p-3 mb-5 bg-white rounded text-primary">
        <div class="mt-2 ml-2">
            <h5>User Name: <a href="{{route('admin.user.profile',$id)}}" class="text-primary text-uppercase">
              {{-- @dd($transactions->first()) --}}
              {{$transactions->first()->user->username??''}}
          </a></h5>
          </div>
      <h2 class="text-center"><u>Bonus From Admin</u></h2>
      <table class="table text-primary text-lg-center">
        <thead class="thead-dark">
          <tr>
            {{-- <th scope="col">Transaction Id</th> --}}
            {{-- <th scope="col">Previous Balance</th>                       --}}
            <th scope="col">Interest Rate (%)</th>
            <th scope="col">Bonus</th>
            <th scope="col">After Bonus Amount</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td>{{$transaction->interest_rate}} </td>
            <td>{{number_format($transaction->bonus)}} {{$currency}}</td>
            <td>{{number_format($transaction->amount)}} {{$currency}}</td>
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