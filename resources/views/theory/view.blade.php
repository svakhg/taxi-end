@extends('layouts.app')

@section('css')
    <link href="/css/dhivehi.css" rel="stylesheet">
@endsection

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Theory</a></li>
    <li class="active">Add</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Theory <Questions></Questions></h3>
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
                
                <table id="taxi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                            
                            <th>Question</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td class="dhivehi-font dhivehi-rtl">{{ $question->body }}</th>
                            <td>
                                <a style="margin:1px" class="btn btn-danger" href="{{ url()->current() }}/delete/{{ $question->id }}" onclick="return confirm('Are you sure you would like to delete this question?.')">Delete</a>
                                <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/edit/{{ $question->id }}">Edit</a>
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
                    window.location.href = './add';
                }
            };
            $('#taxi').DataTable({
                'initComplete': function(){
                    var api = this.api();
                    api.cells('tr', [0]).every(function(){
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