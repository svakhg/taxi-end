@extends('layouts.app')

@section('css')
    <style>
        .view .modal-dialog {
            width: 95%
        }
    </style>
@endsection

@section('content')
<script>
    $(document).ready(function() {
            var dataSrc = [];

            $.fn.dataTable.ext.buttons.add = {
                text: 'Add',
                action: function () {
                    $('#addModal').modal({ show: false})
                    $('#addModal').modal('show');
                }
            };
            $('#driver').DataTable({
                'initComplete': function(){
                    var api = this.api();
                    api.cells('tr', [0, 1, 2, 3, 4, 5, 6, 7, 8 ,9]).every(function(){
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
                        extend: 'add',
                        className: 'btn btn-success',
                    },
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
            });


    });
</script>
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Driver</li>
</ul>    

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Drivers</h3>
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
                <table id="driver" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Taxi No</th>
                            <th>Driver Name</th>
                            <th>Driver Licence No.</th>
                            <th>Driver Licence Expiry</th>
                            <th>Driver Permit No.</th>
                            <th>Driver Permit Expiry</th>
                            <th>Driver Mobile</th>
                            <th>Driver Id Card</th>
                            <th>Driver Perm Address</th>
                            <th>Driver Temp Address</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>                            
                    </thead>
                    <tbody>
                    @foreach($drivers as $driver)
                        <tr>
                            <td>{{ $driver->taxi->taxiNo }}</td>
                            <td>{{ $driver->driverName }}</td>
                            <td>{{ $driver->driverLicenceNo }}</td>
                            <td>{{ $driver->driverLicenceExp }}</td>
                            <td>{{ $driver->driverPermitNo }}</td>
                            <td>{{ $driver->driverPermitExp }}</td>
                            <td>{{ $driver->driverMobile }}</td>
                            <td>{{ $driver->driverIdNo }}</td>
                            <td>{{ $driver->driverPermAdd }}</td>
                            <td>{{ $driver->driverTempAdd }}</td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="c_view('{{ $driver->id }}')">View</button>
                            </td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="c_edit('{{ $driver->id }}')">Edit</button>
                            </td>                                
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-danger" onclick="c_delete('{{ $driver->id }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>        
</div>                               

<div class="modal fade" id="viewModal" role="dialog">
    <div class="view">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 5px solid rgb(255, 3, 3); border-radius: 10px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="margin-left:15px;">Driver View</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-2">
                        <img src="http://via.placeholder.com/180x250">
                    </div>
                    <div class="col-md-10">
                        <div class="row" style="margin-left:10px">
                            <h4 style="display: inline"><strong>Call Code: </strong>XX</h4>
                            <h4 style="display: inline; padding-left:100px"><strong>Taxi No: </strong>T-XXXX</h4>
                            <h4 style="display: inline; padding-left:100px"><strong>Driver Name: </strong>RXXXX RXXXXXX</h4>
                            <hr style="clear:both;"/>
                        </div>
                        <div class="row" style="margin-left:10px">
                            <p>The Alert and Border Will Change Depending on status<p>
                        </div>
                        <div class="row" style="margin-left:10px">
                            <div style="display: inline;float: left; font-size:23px; width:50%; height:100%">
                                <h4 style="text-decoration: underline;">Expiry Dates</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li>Annual Fee Expiry: XX/XX/XXX</li>
                                    <li>Road Worthiness Expiry: XX/XX/XXX</li>
                                    <li>Insurance Expiry: XX/XX/XXX</li>
                                </ul>    
                            </div>
                            <div style="display: inline;float: left; font-size:23px; width:50%; height:100%">
                                <h4 style="text-decoration: underline;">Driver Details</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li>Driver Mobile: XXXXXXX</li>
                                    <li>Driver Licence No: XXXXXXX</li>
                                    <li>Driver Id Card No: AXXXXXX</li>
                                </ul>
                            </div> 
                        </div> 
                        <div class="row" style="margin-top:10px">
                            <div class="alert alert-danger">
                                <strong>Alert!</strong> The Payment for this month is unpaid
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="alert alert-warning">
                                <strong>Alert!</strong> The {show the expired thing(s)} has been expired
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="alert alert-success">
                                <strong>Info</strong> All Payments are complete and Nothing is expired
                            </div>
                        </div>                 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Record</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="driverPhoto">Add Driver Photo</label>
                    <input type='file' name="photoUrl" id="imgInp" />
                    <img id="imgOut" src="#" class="img-responsive" alt="your image" />
                </div>                    
                <script>
                    function readURL(input) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#imgOut').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#imgInp").change(function(){
                        readURL(this);
                    });
                </script>
                <div class="form-group">
                    <label class="control-label" for="name">Taxi No</label>
                    <select class="form-control" name="taxi_id">
                        @foreach($taxis as $taxi)
                            <option value="{{ $taxi->id }}">Taxi No - ( {{ $taxi->taxiNo }} ) Callcode - ( {{ $taxi->callcode->callCode }} ) </option>    
                        @endforeach
                </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverName">Driver Name</label>
                    <input type="text" name="driverName" id="driverName" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverIdNo">Driver Id Card No</label>
                    <input type="text" name="driverIdNo" id="driverIdNo" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverPermAdd">Driver Perm Address</label>
                    <input type="text" name="driverPermAdd" id="driverPermAdd" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverTempAdd">Driver Temp Address</label>
                    <input type="text" name="driverTempAdd" id="driverTempAdd" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="driverMobile">Driver Mobile</label>
                    <input type="text" name="driverMobile" id="driverMobile" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverEmail">DriverEmail</label>
                    <input type="text" name="driverEmail" id="driverEmail" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverLicenceNo">Driver Licence No</label>
                    <input type="text" name="driverLicenceNo" id="driverLicenceNo" class="form-control">
                </div>

                <div class="form-group" style="z-index:2151 !important;">
                    <label class="control-label" for="driverLicenceExp">Driver Licence Exp </label>
                    <div class="input-group date">
                        <input name="driverLicenceExp" id="driverLicenceExp" class="datepicker form-control" data-date-format="yyyy/mm/dd" type="text" value="<?php echo date('Y/m/d') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="driverPermitNo">Driver Permit No</label>
                    <input type="text" name="driverPermitNo" id="driverPermitNo" class="form-control">
                </div>
                
                <div class="form-group" style="z-index:2151 !important;">
                    <label class="control-label" for="driverPermitExp">Driver Permit Exp </label>
                    <div class="input-group date">
                        <input name="driverPermitExp" id="driverPermitExp" class="datepicker form-control" data-date-format="yyyy/mm/dd" type="text" value="<?php echo date('Y/m/d') ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#driverLicenceExp').datepicker();
        $('#driverPermitExp').datepicker();
    });

</script>



@endsection