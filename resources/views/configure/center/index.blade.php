@extends('layouts.app')

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Taxi Centers</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Taxi Centers</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
                <div class="col-md-12">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
        
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                
                                @endif
                            @endforeach
                        </div>
                    </div>             
            <div class="col-md-12">
                <table id="centers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Center Code</th>                            
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Mobile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($centers as $center)
                        <tr>
                            <td>{{ $center->name }}</td>
                            <td>{{ $center->company->name }}</td>
                            <td>{{ $center->cCode }}</td>
                            <td>{{ $center->address }}</td>
                            <td>{{ $center->telephone }}</td>
                            <td>{{ $center->mobile }}</td>
                            <td>
                                <a style="margin:1px" class="btn btn-danger" href="{{ url()->current() }}/delete/{{ $center->id }}" onclick="return confirm('Are you sure you would like to delete this? This process cannot be reversed.')">Delete</a>
                                <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/update/{{ $center->id }}">Edit</a>
                                <a style="margin:1px" class="btn btn-info" href="{{ url()->current() }}/view/{{ $center->id }}">View</a>
                            </td>
                        </tr>                            
                        @endforeach
                    <tbody>
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
                window.location.href = './taxi-center/add';
              }
          };
        
          $('#centers').DataTable({
              'initComplete': function(){
                  var api = this.api();
                  api.cells('tr', [0, 1, 2, 3, 4, 5]).every(function(){
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