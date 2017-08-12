@extends('layouts.app')

@section('content')
<script>
  $(document).ready(function() {
        var dataSrc = [];
        
        $('#payments').DataTable({
            'initComplete': function(){
                var api = this.api();
                api.cells('tr', [0, 1, 2, 3, 4]).every(function(){
                    var data = this.data();
                    if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
            });
            $('.dataTables_filter input[type="search"]', api.table().container())
                .typeahead({
                    source: dataSrc,
                    afterSelect: function(value){
                        api.search(value).draw();
                    }
                }
                );
            },

            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                    {
                    extend: 'print',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    {
                    extend: 'csv',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    {
                    extend: 'excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    {
                    extend: 'pdf',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    {
                    extend: 'colvis',
                    className: 'btn btn-success',
                },
            ],
            columnDefs: [ {
                targets: false,
                visible: false
            } ]
        } );

  } );
</script>
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Payment</a></li>
    <li class="active">Taxi Payments</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Taxi Payments</h3>
    </div>
    <div class="panel-body">
        <div class="row">            
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <table id="payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Call Code</th>
                            <th>Driver Name</th>
                            <th>Taxi Number</th>
                            <th>Taxi Fee</th>
                            <th>date</th>
                            <th>Status</th>
                            <th>Recive Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>   
                            <td>{{ $payment->taxi->callcode->callCode }}</td>
                            <td>{{ $payment->taxi->driver->driverName  }}</td>
                            <td>{{ $payment->taxi->taxiNo }}</td>
                            <td>{{ $payment->taxi->rate }}</td>
                            <td>{{ $payment->month }}/{{ $payment->year }}</td>
                            <td>
                            <?php 
                                if ($payment->paymentStatus == "0") {
                                    echo '<button id="status" style="display: block; margin: auto;"  class="btn-danger" disabled>Not Paid</button>';
                                } elseif($payment->paymentStatus == "1") {
                                    echo '<button id="status" style="display: block; margin: auto;"  class="btn-success" disabled>Paid</button>';
                                } else {
                                    return;
                                }
                            ?>
                            </td>
                            <td><button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#paymentModal" onclick="c_payment('{{ $payment->id }}')">Recive Payment</button>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
    </div>        
</div>

<div class="modal fade" id="paymentModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Recive Payment</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection