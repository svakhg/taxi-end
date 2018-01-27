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
                            <td>{{ date("F", $payment->month) }}/{{ $payment->year }}</td>
                            <td>
                                @if ($payment->paymentStatus == "0")
                                    <button id="status" style="display: block; margin: auto;"  class="btn-danger" disabled>Not Paid</button>
                                @endif
                                @if ($payment->paymentStatus == "1")
                                    <button id="status" style="display: block; margin: auto;"  class="btn-success" disabled>Paid</button>
                                @endif
                            </td>
                            <td>
                                @if ($payment->paymentStatus == "0")
                                    <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#paymentModal" onclick="c_payment('{{ $payment->id }}')">Recive Payment</button>
                                @endif
                                @if ($payment->paymentStatus == "1")
                                    <a href="{{ url()->current() }}/receipt/{{ $payment->id }}" style="display: block; margin: auto;" class="btn btn-info">View</a>
                                @endif
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
                        <textarea name="smsText" class="form-control" maxlength="180" id="smsText">A Payment of MVR 600 on 22/22/2222 was recieved for 12/2017</textarea>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
                <div class="modal-body">
                    <div id="receiptContent">
                        <style>
                            .doubleline {
                            padding: 1px 0;
                            border-bottom: solid 0.180em #000;
                            font-weight: bold;
                            position: relative;
                            margin-bottom: 6px;
                            }
                            .doubleline:after {
                            content: '';
                            border-bottom: solid 0.180em #000;
                            width: 100%;
                            position: absolute;
                            bottom: -3px;
                            left: 0;
                            }
                        </style>
                        <table width="100%" border="0" style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:12px; ">
                            <tbody>
                                <tr>
                                    <td width="80%"><img src="img/logo.png" width="132" height="70" alt=""><br>
                                        <span style="margin-top:5px; margin-left:10px; font-size:12px; font-weight:bold">Giving All Types of Transportation Services</span>
                                    </td>
                                    <td width="20%" colspan="2" align="left">
                                        <table width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Date :</strong></td>
                                                    <td align="right">27 Dec 2017</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Slip No. :</strong></td>
                                                    <td align="right">TPL2661/2017</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TIN No. :</strong></td>
                                                    <td align="right">N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center"><strong><span style="font-size:17px; font-weight:bold">CASH SLIP</span></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table width="100%" border="1" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td width="21%" align="center"><strong>INFO</strong></td>
                                                    <td width="7%" align="center"><strong>MONTH/YEAR</strong></td>
                                                    <td width="37%" align="center"><strong>DESCRIPTION</strong></td>
                                                    <td width="10%" align="center"><strong>QTY</strong></td>
                                                    <td width="11%" align="center"><strong>RATE</strong></td>
                                                    <td width="14%" align="center"><strong>TOTAL</strong></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="5" class="doubleline" style="font-weight:normal">
                                                        &nbsp;7787<br>
                                                        &nbsp;City Cab - Call Code: 63<br>
                                                        &nbsp;Abdulla Naseem<br>
                                                        &nbsp;A137977<br>
                                                        &nbsp;9999741<br>
                                                    </td>
                                                    <td>&nbsp;December 2017</td>
                                                    <td>&nbsp;Monthly Taxi Fee</td>
                                                    <td align="center">1</td>
                                                    <td align="center">600.00</td>
                                                    <td align="right">600.00</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td colspan="2" align="center">SUBTOTAL </td>
                                                    <td align="right">600.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="doubleline">&nbsp;</td>
                                                    <td class="doubleline">&nbsp;</td>
                                                    <td colspan="2" align="center">GST 6%</td>
                                                    <td align="right">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td class="doubleline">&nbsp;&nbsp;&nbsp; Collected By :
                                                        Officer
                                                    </td>
                                                    <td colspan="2" align="center" class="doubleline">TOTAL</td>
                                                    <td class="doubleline" align="right">600.00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" height="30px" style="border-left:0px">&nbsp;&nbsp;&nbsp;&nbsp; Follow Traffic Signals, Avoid Overtaking from Left and Avoid Cell Phones while Driving.</td>
                                                    <td colspan="2" align="center" class="doubleline">TIME </td>
                                                    <td align="right" class="doubleline">15:28</td>
                                                </tr>
                                                <tr>
                                                    <td height="36" colspan="6" align="center" style="border-top:1px solid #000"><strong>
                                                        citycab13@gmail.com | H.Kulhlhavahmaage | Telephone : +9607774713 | Fax : +9603332244 | Email : citycab13@gmail.com 
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


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

                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd<10) {
                    dd='0'+dd;
                } 
                if(mm<10) {
                    mm='0'+mm;
                } 
                var today = dd+'/'+mm+'/'+yyyy;
                
                var paymentMonth = result.month;
                var paymentYear = result.year;

                var smsGeText = "A Payment of MVR 600 on "+ today +" was received for "+ paymentMonth + "/" + paymentYear + '. Taxi number: T-'+ result.taxi.taxiNo;
                $('#smsText').html(smsGeText);
            }
        });
    }
</script>   
@endsection