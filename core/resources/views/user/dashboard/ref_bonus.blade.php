@extends('user.home')

@section('user-home')
<h1 class="text-center">Referral Transactions</h1>
<div class="container-fluid table-responsive shadow-lg p-3 mb-5 bg-white rounded">
    <table class="table text-primary text-lg-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Referral Name</th>                      
          <th scope="col">Bonus Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transactions as $transaction)
        <tr>
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
          Total Bonus: {{$transactions->sum('bonus_amount')}} {{$currency}}
        </td>
      </tfoot>
    </table>
    
  </div>
@endsection