@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Report</a></li>
    <li class="active">Payment History</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Payment History</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                            <th>#</th>
                            <th>Call Code</th>
                            <th>Taxi Number</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Subtotal</th>
                            <th>Gst</th>
                            <th>Total</th>
                            <th>Slip Number</th>
                            <th>Description	</th>
                            <th>Collected By</th>
                    </thead>
                    <tbody>
                        @foreach ($paids as $paid)
                            <tr>
                                <td>{{ $paid->id }}</td>
                                <td>{{ $paid->taxi_id }}</td>
                                <td>{{ $paid->taxi_id }}</td>
                                <td>{{ $paid->month }}</td>
                                <td>{{ $paid->year }}</td>
                                <td>{{ $paid->qty }}</td>
                                <td>{{ $paid->taxi_id }}</td>
                                <td>{{ $paid->subtotal }}</td>
                                <td>{{ $paid->gstAmount }}</td>
                                <td>{{ $paid->totalAmount }}</td>
                                <td>{{ $paid->slipNo }}</td>
                                <td>{{ $paid->desc }}</td>
                                <td>{{ $paid->user_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            
        </div>
    </div>        
</div>
@endsection