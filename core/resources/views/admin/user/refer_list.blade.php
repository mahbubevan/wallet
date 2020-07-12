@extends('admin.layouts.app')

@section('content')
<h1 class="text-center">Referral Lists</h1>
<div class="container-fluid table-responsive shadow-lg p-3 mb-5 bg-white rounded">   
    <div class="mt-2 ml-2">
        <h5>User Name: <a href="{{route('admin.user.profile',$id)}}" class="text-primary text-uppercase">
          {{$user_name}}
      </a></h5>
      </div>
  <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Joining Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($ref_users as $user)
          <tr>
              <th scope="row">{{$user->name}}</th>
              <td>{{$user->username}}</td>
              <td>
                 {{$user->email}}
              </td>
              
              <td>{{$user->created_at->diffforhumans()}}</td>
              <td>
                  <a href="{{route('user.name.sendmoney',$user->username)}}" class="btn btn-sm btn-outline-success"> Send Money </a>
              </td>
            </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection