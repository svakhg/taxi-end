@extends('layouts.app')

@section('css')
    <style>
        .view .modal-dialog {
            width: 95%
        }
    </style>
@endsection

@section('content')

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
                            <th>Actions</th>
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
                                <a style="margin:1px" class="btn btn-danger" href="{{ url()->current() }}/delete/{{  $driver->id }}" onclick="return confirm('Are you sure you would like to delete this? This process cannot be reversed.')">Delete</a>
                                <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/update/{{  $driver->id }}">Edit</a>
                                <a style="margin:1px" class="btn btn-info" href="{{ url()->current() }}/view/{{  $driver->id }}">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>        
</div>                               




@endsection

@section('js')
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
@endsection