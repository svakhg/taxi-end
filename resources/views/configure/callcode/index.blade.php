@extends('layouts.app')

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
      
        $('#callcode').DataTable({
            'initComplete': function(){
                var api = this.api();
                api.cells('tr', [0, 1]).every(function(){
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
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Call Code</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Call Codes</h3>
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
                <table id="callcode" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="col-md-5">Taxi Center</th>
                            <th class="col-md-3">Call Code</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($callcodes as $callcode)
                        <tr>
                            <td>{{ $callcode->taxicenter->name }}</td>
                            <td>{{ $callcode->callCode }}</td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="c_view('{{$callcode -> id}}')">View</button>
                            </td>
                            <td>    
                                <button style="display: block; margin: auto;" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="c_edit('{{$callcode -> id}}')">Edit</button>
                            </td>
                            <td>    
                                <button style="display: block; margin: auto;" class="btn btn-danger" onclick="c_delete('{{$callcode -> id}}')">Delete</button>
                            </td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>        
</div>                

<input type="hidden" name="hidden_view" id="hidden_view" value="{{ url('configure/call-code/view') }}">
<input type="hidden" name="hidden_delete" id="hidden_delete" value="{{ url('configure/call-code/delete') }}">

<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Record</h4>
            </div>
            <div class="modal-body">
                {!! BootForm::open()->post()->action(''); !!}
                {!! BootForm::token() !!}
                <div class="form-group">
                    <label class="control-label" for="name">Taxi Centers</label>
                    <select class="form-control" name="center_id">
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>    
                        @endforeach
                </select>
                </div>
                {!! BootForm::text('Center Code', 'callCode') !!}
            </div>
            <div class="modal-footer">
                {!! BootForm::submit('Submit')->class('btn btn-success') !!}
                {!! BootForm::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <p><b>Taxi Center Name : </b><span id="view_name" class="text-success"></span></p>
                <p><b>Call Code : </b><span id="view_ccode" class="text-success"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function c_view(id){
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET", 
            data: {"id":id}, 
            success: function(result){
            console.log(result);
            $("#view_name").text(result.center.name);
            $("#view_ccode").text(result.callCode);
            }
        });
    }
    function c_delete(id){
      var conf = confirm("Are you sure want to delete??");
      if(conf){
        var delete_url = $("#hidden_delete").val();
        $.ajax({
          url: delete_url,
          type:"POST", 
          data: {"id":id,_token: "{{ csrf_token() }}"}, 
          success: function(response){
            alert(response);
            location.reload(); 
          }
        });
      }
      else{
        return false;
      }
    }
</script>    

@endsection
