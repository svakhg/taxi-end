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
      
        $('#taxi').DataTable({
            'initComplete': function(){
                var api = this.api();
                api.cells('tr', [0, 1, 2, 3, 4, 5, 6]).every(function(){
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


  } );
</script>
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li class="active">Taxi</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Taxis</h3>
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
                <table id="taxi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                            
                            <th>Call Code</th>
                            <th>Taxi Center</th>
                            <th>Taxi No</th>
                            <th>Owner Name</th>
                            <th>Owner Mobile</th>
                            <th>Register Date</th>
                            <th>Rate</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taxis as $taxi)
                        <tr>
                            <td>{{ $taxi->callcode->callCode }}</th>
                            <td>{{ $taxi->callcode->taxicenter->name }}</td>
                            <td>{{ $taxi->taxiNo }}</td>
                            <td>{{ $taxi->taxiOwnerName }}</td>
                            <td>{{ $taxi->taxiOwnerMobile }}</td>
                            <td>{{ $taxi->registeredDate }}</td>
                            <td>{{ $taxi->rate }}</td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="c_view('{{ $taxi->id }}')">View</button>
                            </td>
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="c_edit('{{ $taxi->id }}')">Edit</button>
                            </td>                                
                            <td>
                                <button style="display: block; margin: auto;" class="btn btn-danger" onclick="c_delete('{{ $taxi->id }}')">Delete</button>
                            </td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
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
                {!! BootForm::open()->post()->action(''); !!}
                {!! BootForm::token() !!}
                <div class="form-group">
                    <label class="control-label" for="name">Call Code</label>
                    <select class="form-control" name="callcode_id">
                        @foreach($callcodes as $callcode)
                            <option value="{{ $callcode->id }}">{{ $callcode->callCode }} - ( {{ $callcode->taxicenter->name }} )</option>    
                        @endforeach
                </select>
                </div>
                {!! BootForm::text('Taxi No.', 'taxiNo') !!}
                {!! BootForm::text('Taxi Chasis No.', 'taxiChasisNo') !!}
                {!! BootForm::text('Taxi Engine No.', 'taxiEngineNo ') !!}
                {!! BootForm::text('Taxi Brand', 'taxiBrand') !!}
                {!! BootForm::text('Taxi Model', 'taxiModel') !!}
                {!! BootForm::text('Taxi Color', 'taxiColor') !!}
                {!! BootForm::text('Taxi Owner Name', 'taxiOwnerName') !!}
                {!! BootForm::text('Taxi Owner Mobile', 'taxiOwnerMobile') !!}
                {!! BootForm::text('Taxi Owner Email', 'taxiOwnerEmail') !!}
                {!! BootForm::text('Taxi Owner Address', 'taxiOwnerAddress') !!}
                
                <div class="form-group" style="z-index:2151 !important;">
                    <label class="control-label" for="registeredDate">Registered Date </label>
                    <div class="input-group date">
                        <input name="registeredDate" id="registeredDate" class="datepicker form-control" data-date-format="dd/mm/yyyy" type="text" value="<?php echo date('d/m/Y') ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="anualFeeExpiry">Annual Fee Expiry</label>
                    <div class="input-group date">
                        <input type="text" name="anualFeeExpiry" id="anualFeeExpiry" class="datepicker form-control" data-date-format="dd/mm/yyyy" type="text" value="<?php echo date('d/m/Y') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="roadWorthinessExpiry">Road Worthiness Expiry</label>
                    <div class="input-group date">
                        <input type="text" name="roadWorthinessExpiry" id="roadWorthinessExpiry" class="datepicker form-control" data-date-format="dd/mm/yyyy" type="text" value="<?php echo date('d/m/Y') ?>">
                    </div>    
                </div>

                <div class="form-group">
                    <label class="control-label" for="insuranceExpiry">Insurance Expiry</label>
                    <div class="input-group date">
                        <input type="text" name="insuranceExpiry" id="insuranceExpiry" class="datepicker form-control" data-date-format="dd/mm/yyyy" type="text" value="<?php echo date('d/m/Y') ?>">
                    </div>    
                </div>
                {!! BootForm::text('Rate', 'rate') !!}
            </div>
            <div class="modal-footer">
                {!! BootForm::submit('Submit')->class('btn btn-success') !!}
                {!! BootForm::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="hidden_view" id="hidden_view" value="{{ url('configure/taxi/view') }}">
<input type="hidden" name="hidden_delete" id="hidden_delete" value="{{ url('configure/taxi/delete') }}">

<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <p><b>Center Name : </b><span id="view_cname" class="text-success"></span></p>
                <p><b>Call Code : </b><span id="view_ccode" class="text-success"></span></p>
                <hr />
                <p><b>Taxi No : </b><span id="view_taxiNo" class="text-success"></span></p>
                <p><b>Taxi Chasis No : </b><span id="view_taxiChasisNo" class="text-success"></span></p>
                <p><b>Taxi Engine No : </b><span id="view_taxiEngineNo" class="text-success"></span></p>
                <hr />
                <p><b>Taxi Brand : </b><span id="view_taxiBrand" class="text-success"></span></p>
                <p><b>Taxi Model : </b><span id="view_taxiModel" class="text-success"></span></p>
                <p><b>Taxi Color : </b><span id="view_taxiColor" class="text-success"></span></p>
                <hr />
                <p><b>Taxi Owner Name : </b><span id="view_taxiOwnerName" class="text-success"></span></p>
                <p><b>Taxi Owner Mobile : </b><span id="view_taxiOwnerMobile" class="text-success"></span></p>
                <p><b>Taxi Owner Email : </b><span id="view_taxiOwnerEmail" class="text-success"></span></p>
                <p><b>Taxi Owner Address : </b><span id="view_taxiOwnerAddress" class="text-success"></span></p>
                <hr />
                <p><b>Registered Date : </b><span id="view_registeredDate" class="text-success"></span></p>
                <p><b>Anual Fee Expiry : </b><span id="view_anualFeeExpiry" class="text-success"></span></p>
                <p><b>Road Worthiness Expiry : </b><span id="view_roadWorthinessExpiry" class="text-success"></span></p>
                <p><b>Insurance Expiry : </b><span id="view_insuranceExpiry" class="text-success"></span></p>
                <hr />
                <p><b>Rate : </b><span id="view_rate" class="text-success"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#registeredDate').datepicker();
        $('#anualFeeExpiry').datepicker();
        $('#roadWorthinessExpiry').datepicker();
        $('#insuranceExpiry').datepicker();
    });
    function c_view(id){
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET", 
            data: {"id":id}, 
            success: function(result){
            console.log(result);
            $("#view_cname").text(result.texicenter.name);
            $("#view_ccode").text(result.callcode.callCode);
            
            $("#view_taxiNo").text(result.taxiNo);
            $("#view_taxiChasisNo").text(result.taxiChasisNo);
            $("#view_taxiEngineNo").text(result.taxiEngineNo);
            
            $("#view_taxiBrand").text(result.taxiBrand);
            $("#view_taxiModel").text(result.taxiModel);
            $("#view_taxiColor").text(result.taxiColor);
            
            $("#view_taxiOwnerName").text(result.taxiOwnerName);
            $("#view_taxiOwnerMobile").text(result.taxiOwnerMobile);
            $("#view_taxiOwnerEmail").text(result.taxiOwnerEmail);
            $("#view_taxiOwnerAddress").text(result.taxiOwnerAddress);
            
            $("#view_registeredDate").text(result.registeredDate);
            $("#view_anualFeeExpiry").text(result.anualFeeExpiry);
            $("#view_roadWorthinessExpiry").text(result.roadWorthinessExpiry);
            $("#view_insuranceExpiry").text(result.insuranceExpiry);
            
            $("#view_rate").text(result.rate);
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