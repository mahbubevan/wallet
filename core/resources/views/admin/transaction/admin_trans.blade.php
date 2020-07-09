@extends('admin.layouts.app')

@section('content')
    <h1 class="text-center">Transaction By Admin To All Users</h1>
    <div class="rcv-bonus-from-my-refe-transaction table-responsive shadow-lg p-3 mb-5 bg-white rounded">   
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Transaction Id</th>
              <th scope="col">User</th> 
              <th scope="col">Interest Rate (%)</th>                      
              <th scope="col">After Given Interest - Amount</th>
              <th scope="col">Given By Admin</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trans_by_admin as $transaction)
            <tr>
              <th scope="row">{{$transaction->id}}</th>
              {{-- @dd($transaction->sender) --}}
              <td>{{$transaction->user->name}}</td>
              <td>
                  {{$transaction->interest_rate}}     
              </td>
              <td>{{number_format($transaction->user->wallet->current_balance,2)}} ({{$currency}})</td>
              <td>{{$transaction->admin->name}}</td>
              <td>{{$transaction->created_at->diffforhumans()}}</td>
            </tr>
            @endforeach                 
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th><span class="text-info">Total Amount = </span> <span style="font-size: 18px" class="text-danger">{{number_format($total_amount,2)}} ({{$currency}}) </span></th>
            </tr>
          </tfoot>
        </table>
        <div class="text-center">
            {{$trans_by_admin->links()}}
        </div>
      </div>
    </div>
@endsection