@extends('user.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="user-transaction-send col-md-4 table-responsive mx-auto  shadow-lg p-3 mb-5 bg-white text-primary rounded">
            <h2 class="text-center"><u>Refer List</u></h2>
            <table class="table text-primary text-lg-center">
              <thead class="thead-dark">
                <tr>
                  {{-- <th scope="col">Transaction Id</th> --}}
                  <th scope="col">Receiver Name</th>                     
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($referto as $refer)
                <tr>
                  {{-- <th scope="row">{{$transaction->id}}</th> --}}
                  {{-- @dd($transaction->receiver) --}}
                  <td>{{$refer->name}}</td>
                  <td>
                      <a href="{{route('user.name.sendmoney',$refer->username)}}" class="btn btn-md btn-success">Send Money <span class="ml-3"><i class="far fa-paper-plane"></i></span></a>
                  </td>
                </tr>
                @endforeach                 
              </tbody>
            </table>
            
              {{-- @dd($transactions->links()) --}}
             
              {{-- {{ $send_money->links() }} --}}
            
          </div>
    </div>
@endsection