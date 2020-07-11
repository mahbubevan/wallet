@extends('admin.layouts.app')

@section('content')
<h1 class="text-center">User Log</h1>
<div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Referred By</th>
            <th scope="col">Email</th>
            <th scope="col">Wallet Balance</th>
            <th scope="col">Join Date</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">Zip</th>
            <th scope="col">NID</th>
            <th scope="col">Img</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users->sortDesc() as $user)
            <tr>
                {{-- <th scope="row">{{$user->id}}</th> --}}
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{route('admin.user.transaction',$user->id)}}" class="text-info">
                        {{$user->username}}
                    </a>
                </td>
                @if($user->referred_by)
                    <td>{{$user->referred_by->name}}</td>
                    @else 
                    <td><span class="text-secondary">No Reference</span></td>
                @endif
                <td>{{$user->email}}</td>
                <td>{{$user->wallet->current_balance}}</td>
                <td>     
                    {{$user->created_at->diffforhumans()}}
                </td>
                <td>{{$user->profile->address}}</td>
                <td>{{$user->profile->city}}</td>
                <td>{{$user->profile->zip}}</td>
                <td>{{$user->profile->nid}}</td>
                <td>
                    <img class="img-thumbnail ing-fluid" width="50px" height="50px" src="{{asset($user->profile->img)}}" alt="">
                </td>
                <td>
                    <a href="{{route('admin.user.byId',$user->id)}}" target="_blank" class="btn btn-sm btn-outline-warning text-info">
                        Logged In As User
                    </a>
                    <a href="{{route('admin.user.profile',$user->id)}}" class="btn btn-sm btn-success">
                        Edit
                    </a>
                    <a onclick="return confirm('Are You Sure ?')" id="delete-btn" href="{{route('admin.user.destroy',$user->id)}}" class="btn btn-sm btn-danger">
                        Delete
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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Users: {{count($users)}}</td>
        </tfoot>
    </table>
    <div class="text-center">
        {{$users->links()}}
    </div>
</div>
@endsection

@push('jquery')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="">
    // $(document).ready(function(){
    //     $("#delete-btn").click(function(){
    //         return confirm("Are you sure?")
    //     })
    // })
</script>
@endpush