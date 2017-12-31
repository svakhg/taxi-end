@extends('layouts.app')

@section('content')

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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($callcodes as $callcode)
                        <tr>
                            <td>{{ $callcode->taxicenter->name }}</td>
                            <td>{{ $callcode->callCode }}</td>
                            <td>
                                <a style="margin:1px" class="btn btn-danger" href="{{ url()->current() }}/delete/{{ $company->id }}" onclick="return confirm('Are you sure you would like to delete this? This process cannot be reversed.')">Delete</a>
                                <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/update/{{ $company->id }}">Edit</a>
                                <a style="margin:1px" class="btn btn-info" href="{{ url()->current() }}/view/{{ $company->id }}">View</a>
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
                window.location.href = './call-code/add';
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
@endsection