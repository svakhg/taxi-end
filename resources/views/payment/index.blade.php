@extends('layouts.app')

@section('content')
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
                            <th>Center Name</th>
                            <th>Taxi Fee</th>
                            <th>Date</th>
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
                            <td>{{ $payment->taxi->callcode->taxicenter->name }}</td>
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
                            <td>
                            <?php
                            if ($payment->paymentStatus == "0") 
                            {
                            ?>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#paymentModal" onclick="c_payment('{{ $payment->id }}')">Recive Payment</button>
                            <?php
                            } elseif($payment->paymentStatus == "1") {
                                echo '<button style="display: block; margin: auto;" class="btn btn-info" disabled>View</button>';
                            } else {
                                return;
                            }
                            ?>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
    </div>        
</div>

<input type="hidden" name="hidden_view" id="hidden_view" value="{{ url('payments/taxi-payment/view') }}">
<div class="modal fade" id="paymentModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Recive Payment</h4>
            </div>
            <div class="modal-body" style="font-size: 15px;">
            <p>Taxi Number: <span id="view_taxiNo" class="text-success"></span></p>
            <p>Call Code: <span id="view_callCode" class="text-success"></span></p>
            <p>Center Name: <span id="view_centerName" class="text-success"></span></p>
            <p>Driver Name: <span id="view_driverName" class="text-success"></span></p>
            <p>Recipt Number: <span id="view_reciptNo" class="text-success"></span></p>
            <form action="" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="total">Total Amount</label>
                    <input type="number" name="total" class="form-control" id="view_total" placeholder="Enter Amount">
                </div>
                
                <div class="form-group">
                    <label for="total">Fine on Late Payment</label>
                    <input type="number" name="subtotal" class="form-control" id="view_subtotal" placeholder="Enter Amount">
                </div>
                
                <input type="hidden" name="idPayment" id="idPayment" class="form-control" value="">
                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" onclick="javascript:yesnoCheck();" name="send_sms" id="noCheck" value="0" checked>
                            Dont Send Sms
                        </label>
                        <label>
                            <input type="radio" onclick="javascript:yesnoCheck();" name="send_sms" id="yesCheck" value="1">
                            Send Sms
                        </label>
                    </div>    
                </div>
                
                <div id="ifYes" style="display: none">
                    <div class="form-group">
                        <label for="total">Driver Number</label>
                        <input type="text" name="driverNumber" id="view_driverNumber" class="form-control" placeholder="Enter Driver Phone Number">
                    </div>
                   
                    <div class="form-group">
                        <label for="total">SMS Text</label>
                        <textarea name="smsText" class="form-control" maxlength="180" id="smsText">This is a sample text</textarea>
                        <script>
                            $('#smsText').keyup(function () {
                            var max = 180;
                            var len = $(this).val().length;
                            if (len >= max) {
                                $('#charNum').text(' you have reached the limit');
                            } else {
                                var char = max - len;
                                $('#charNum').text(char + ' characters left');
                            }
                            });
                        </script>
                        <div id="charNum"></div>
                    </div>
                </div>
                <script>
                    function yesnoCheck() {
                        if (document.getElementById('yesCheck').checked) {
                            document.getElementById('ifYes').style.display = 'block';
                        }
                        else document.getElementById('ifYes').style.display = 'none';

                    }
                </script>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
var totalValue = 0; 
    function c_payment(id){
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET", 
            data: {"id":id}, 
            success: function(result){
                $("#idPayment").val(result.id);
                $("#view_taxiNo").text(result.taxi.taxiNo);
                $("#view_callCode").text(result.callcode.callCode);
                $("#view_centerName").text(result.center.name);
                $("#view_driverName").text(result.taxi.driver.driverName);
                $("#view_total").val(result.taxi.rate);
                $("#view_subtotal").val(result.subtotal);
                $("#view_driverNumber").val(result.taxi.driver.driverMobile);

                var z = 0;
                var x = $("#view_total").val();
                var y = $("#view_subtotal").val();
                var z = x + y;
                $("#totalAmount").val(z);
                $("#totalAmountA").text(z);
            }
        });
    }
</script>   
@endsection

@section('js')
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
@endsection