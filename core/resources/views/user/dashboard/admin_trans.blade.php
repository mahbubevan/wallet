@extends('user.home')

@section('user-home')
<h1 class="text-center">Bonus From System</h1>
<div class="container-fluid table-responsive shadow-lg p-3 mb-5 bg-white rounded">   
    <div class="row">
    </div>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Transaction Id</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <th scope="row">{{$transaction->trax_id}}</th>
                <td>{{number_format($transaction->amount,2)}} ({{$currency}})</td>
                <td> {{$transaction->created_at->diffforhumans()}} </td>
              </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{$transactions->links()}}
    </div>
</div>
@endsection