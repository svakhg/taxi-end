@extends('layouts.app')

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School</a></li>
    <li><a href="{{ url('driving-school') }}" class="active">All Users</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">All Users</h3>
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