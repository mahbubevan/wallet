@extends('admin.layouts.app')

@section('page-title')
    Notification
@endsection
@section('content')
<h3 class="text-primary">Notifications</h3>
<div class="rcv-bonus-from-my-refe-transaction table-responsive shadow-lg p-3 mb-5 mt-2 bg-white rounded">   
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Notification</th>
          <th scope="col">Date</th> 
          <th scope="col">Action</th>                      
        </tr>
      </thead>
      <tbody>
          @foreach ($notifications->sortDesc() as $notify)
              <tr>
                  <td>{!!htmlspecialchars_decode($notify->description) !!}</td>
                  <td>{{$notify->created_at->diffforhumans()}}</td>
                  <td>
                    
                      @if ($notify->seen==0)
                        <a href="{{route('admin.notification.reverse',$notify->id)}}" class="btn btn-md btn-outline-success">Seen</a>
                         @else 
                         <a href="{{route('admin.notification.reverse',$notify->id)}}" class="btn btn-md btn-outline-danger">Un Seen</a>
                      @endif
                        {{-- <a href="{{route('admin.notification.unseen',$notify->id)}}" class="btn btn-md btn-danger">Un Seen</a> --}}
                     
                        {{-- <a href="" class="btn btn-md btn-success">Seen</a>
                        <a href="" class="btn btn-md btn-outline-danger">Un Seen</a>
                      @endif --}}
                      
                  </td>
              </tr>
          @endforeach
      </tbody>

    </table>
@endsection