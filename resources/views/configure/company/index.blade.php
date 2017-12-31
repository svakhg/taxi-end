@extends('layouts.app')

@section('content')



<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Company</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Company</h3>
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
                <table id="company" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Island</th>
                            <th>Atoll/City</th>
                            <th>Telephone</th>
                            <th>Fax</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->address }}</td>
                            <td>{{ $company->island }}</td>
                            <td>{{ $company->city }}</td>
                            <td>{{ $company->telephone }}</td>
                            <td>{{ $company->fax }}</td>
                            <td>{{ $company->mobile }}</td>
                            <td>{{ $company->email }}</td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="c_view('{{$company -> id}}')">View</button>
                            </td>
                            <td>                                
                                <button style="display: block; margin: auto;" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="c_edit('{{$company -> id}}')">Edit</button>
                            </td>
                            <td>    
                                <!-- <button style="display: block; margin: auto;" class="btn btn-danger" onclick="c_delete('{{$company -> id}}')">Delete</button> -->
                                <button style="display: block; margin: auto;" class="disabled btn btn-danger" onclick="">Delete</button>
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
        
        $('#company').DataTable({
            'initComplete': function(){
                var api = this.api();
                api.cells('tr', [0, 1, 2, 3, 4, 5, 6, 7]).every(function(){
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
        } );

    } );
</script>  
@endsection