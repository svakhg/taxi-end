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

<input type="hidden" name="hidden_view" id="hidden_view" value="{{ url('configure/company/view') }}">
<input type="hidden" name="hidden_delete" id="hidden_delete" value="{{ url('configure/company/delete') }}">

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
            {!! BootForm::text('Name', 'name') !!}
            {!! BootForm::text('GST Tin No', 'GSTTin') !!}
            {!! BootForm::text('Registration No', 'RegNo') !!}
            {!! BootForm::text('Address', 'address') !!}
            {!! BootForm::text('Island', 'island') !!}
            {!! BootForm::text('City', 'city') !!}
            {!! BootForm::text('Telephone', 'telephone') !!}
            {!! BootForm::text('Fax', 'fax') !!}
            {!! BootForm::text('Mobile', 'mobile') !!}
            {!! BootForm::text('Email', 'email') !!}
            {!! BootForm::text('Website', 'website') !!}
            {!! BootForm::text('Owner Name', 'ownername') !!}
            {!! BootForm::text('Owner Email', 'owneremail') !!}
            {!! BootForm::text('Owner Mobile', 'ownermobile') !!}
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
                    <p><b>Company Name : </b><span id="view_name" class="text-success"></span></p>
                    <p><b>GST Tin No : </b><span id="view_GSTTin" class="text-success"></span></p>
                    <p><b>Reg No : </b><span id="view_RegNo" class="text-success"></span></p>
                    <p><b>Address : </b><span id="view_address" class="text-success"></span></p>
                    <p><b>Island : </b><span id="view_island" class="text-success"></span></p>
                    <p><b>City : </b><span id="view_city" class="text-success"></span></p>
                    <p><b>Telephone : </b><span id="view_telephone" class="text-success"></span></p>
                    <p><b>Fax : </b><span id="view_fax" class="text-success"></span></p>
                    <p><b>Mpbile : </b><span id="view_mobile" class="text-success"></span></p>
                    <p><b>Email : </b><span id="view_email" class="text-success"></span></p>
                    <p><b>Website : </b><span id="view_website" class="text-success"></span></p>
                    <p><b>Owner Name : </b><span id="view_ownername" class="text-success"></span></p>
                    <p><b>Owner Email : </b><span id="view_owneremail" class="text-success"></span></p>
                    <p><b>Owner Mobile : </b><span id="view_ownermobile" class="text-success"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    

    <script type="text/javascript">
    function c_view(id)
    {
      var view_url = $("#hidden_view").val();
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#view_name").text(result.name);
          $('#view_GSTTin').text(result.GSTTin);
          $('#view_RegNo').text(result.RegNo);
          $('#view_address').text(result.address);
          $('#view_island').text(result.island);
          $('#view_city').text(result.city);
          $('#view_telephone').text(result.telephone);
          $('#view_fax').text(result.fax);
          $('#view_mobile').text(result.mobile);
          $("#view_email").text(result.email);
          $('#view_website').text(result.website);
          $('#view_ownername').text(result.ownername);
          $('#view_owneremail').text(result.owneremail);
          $('#view_ownermobile').text(result.ownermobile);
        }
      });
    }


    function c_delete(id)
    {
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