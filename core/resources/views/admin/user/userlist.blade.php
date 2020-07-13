@extends('admin.layouts.app')
@section('page-title')
    User List
@endsection
@section('content')
<h1 class="text-center">User Log</h1>
<div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
    {{-- <div>
        <input type="text" id="search_input" placeholder="search" class="form-control w-25 p-3 m-right mb-2">
    </div> --}}
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Referred By</th>
            <th scope="col">Email</th>
            <th scope="col">Wallet Balance</th>
            <th scope="col">Join Date</th>
            <th scope="col">Img</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="search-result">
            @foreach ($users->sortDesc() as $user)
            <tr>
                {{-- <th scope="row">{{$user->id}}</th> --}}
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{route('admin.user.profile',$user->id)}}" class="text-info">
                        {{$user->username}}
                    </a>
                </td>
                @if($user->referred_by)
                    <td>{{$user->referred_by->name}}</td>
                    @else 
                    <td><span class="text-secondary">N/A</span></td>
                @endif
                <td>{{$user->email}}</td>
                <td>{{$user->wallet->current_balance}}</td>
                <td>     
                    {{$user->created_at->diffforhumans()}}
                </td>
                <td>
                    <img class="img-thumbnail ing-fluid" width="50px" height="50px" src="{{asset($user->profile->img)}}" alt="">
                </td>
                <td>
                    <a href="{{route('admin.user.byId',$user->id)}}" target="_blank" class="btn btn-sm btn-outline-warning text-info btn-block">
                        Logged In As User
                    </a>
                    <a href="{{route('admin.user.profile',$user->id)}}" class="btn btn-sm btn-success btn-block">
                        Edit
                    </a>
                </td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Users: {{count($users)}}</td>
        </tfoot>
    </table>
    <div class="text-center">
        {{-- {{dd($users->links())}} --}}
        {{$users->links()}}
    </div>
</div>
@endsection

@push('jquery')
@push('jquery')
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/user-search.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@endpush