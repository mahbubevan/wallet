@extends('admin.layouts.app')
@section('page-title')
    User List
@endsection
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
                    <a href="{{route('admin.user.byId',$user->id)}}" target="_blank" class="btn btn-sm btn-outline-warning text-info">
                        Logged In As User
                    </a>
                    <a href="{{route('admin.user.profile',$user->id)}}" class="btn btn-sm btn-success w-50">
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
        {{$users->links()}}
    </div>
</div>
@endsection

@push('jquery')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
{{-- 
<script src="">
        function deleteAlert()
        {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    }
                })
        }
</script> --}}
@endpush