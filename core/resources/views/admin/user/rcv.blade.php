@extends('admin.layouts.app')

@section('content')
    
<h1 class="text-center">Receive Money Transaction Logs</h1>
<div class="container-fluid table-responsive shadow-lg p-3 mb-5 bg-white rounded">   
    <div class="mt-2 ml-2">
        <h5>User Name: <a href="{{route('admin.user.profile',$id)}}" class="text-primary text-uppercase">
          {{$transactions->first()->username??''}}
      </a></h5>
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
            @foreach ($transactions as $transaction)
            <tr>
                <th scope="row">{{$transaction->trax_id}}</th>
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
                <td>{{number_format($transaction->current_balance,2)}} ({{$currency}})</td>
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
@endsection