@extends('admin.layouts.app')
@section('page-title')
    Email
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Email</h1>
    <div class="row">
        <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
            <h5>Inobx</h5>
            <table class="table">
                <div class="row">
                    <div class="col-md-3">
                        <span id="total_count" class="text-success"></span>
                    </div>
                    <div class="col text-right pull-right">
                        <input style="display:inline-block" id="search_input" type="text" class="shadow-lg p-3 mb-5 bg-white rounded  w-25 pull-right form-control mb-5"/><a id="searchButton" class="btn btn-sm"> <span style="font-size: 18px"><i class="fas fa-search"></i> </span> </a>
                    </div>
                </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">From</th>           
                        <th scope="col">Subject</th>
                        <th scope="col">Body</th>
                        <th scope="col">Action</th>
                        <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($emails->sortDesc() as $email)
                    <tr>
                        <td>{{$email->name}}</td>
                        <td>{{$email->from}}</td>
                        <td>{{$email->subject}}</td>
                        <td>{{$email->body}}</td>
                        <td>             
                        @if ($email->status==0)
                          <a href="{{route('admin.email.reverse',$email->id)}}" class="btn btn-md btn-outline-success">Seen</a>
                           @else 
                           <a href="{{route('admin.email.reverse',$email->id)}}" class="btn btn-md btn-outline-danger">Un Seen</a>
                        @endif
                        </td> 
                        <td>{{$email->created_at->diffforhumans()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection