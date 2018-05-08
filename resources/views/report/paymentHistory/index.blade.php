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
                <form class="form-inline" action="" method="GET">
                    <div class="form-group">
                        <label for="from">Date From</label>
                        <input type="date" class="form-control" id="from" name="from"
                        @if (request()->exists('from'))
                            value="{{ request('from') }}"
                        @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="to">Date To</label>
                        <input type="date" class="form-control" id="to" name="to"
                        @if (request()->exists('to'))
                            value="{{ request('to') }}"
                        @endif
                        >
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>                      
            </div>
            <div class="col-md-12">
                @if(request()->exists('to') AND request()->exists('from'))

                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Call Code</th>
                            <th>Taxi Number</th>
                            <th>Date</th>
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
                            <?php $i = 0 ?>
                            @foreach ($paids as $paid)
                            <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $paid->taxi->callcode->callCode }}</td>
                                    <td>{{ $paid->taxi->taxiNo }}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('m', $paid->month)->format('F') . ' ' . $paid->year }}</td>
                                    <td>{{ $paid->qty }}</td>
                                    <td>{{ $paid->taxi->rate }}</td>
                                    <td>{{ $paid->subtotal }}</td>
                                    <td>{{ $paid->gstAmount }}</td>
                                    <td>{{ $paid->totalAmount }}</td>
                                    <td>{{ $paid->slipNo }}</td>
                                    <td>{{ $paid->desc }}</td>
                                    <td>{{ $paid->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                @endif
            </div> 
        </div>
    </div>        
</div>
@endsection