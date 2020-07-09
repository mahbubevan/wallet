@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <h1 class="text-center">Search Transaction</h1>
    <div class="row">
        <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
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
                        <th scope="col">Transaction ID</th>
                        <th scope="col">User</th>           
                        <th scope="col">Amount</th>
                        <th scope="col">Charge</th>
                        <th scope="col">Current Balance</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Status</th>
                        <th scope="col">Transaction Date</th>
                    </tr>
                  </thead>
                  <tbody id="table-data">
                    
                </tbody>
            </table>
            <div id="pagination"></div>
        </div>
    </div>
</div>
    
@endsection

@push('jquery')
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/search.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush