@extends('layouts.app')

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School</a></li>
    <li><a href="{{ url('driving-school') }}" class="active">All Registered Driving Students</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">All Driving School Students</h3>
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
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> Print the Page</button>
                        <a href="{{ url('driving-school/create') }}" class="btn btn-primary" style="color:white;"><i class="fa fa-user-plus" aria-hidden="true"></i> Register a new Student</a>
                        <button type="button" class="btn btn-warning" onclick="excelGen()">Export To Excel</button>
                    </div>         
                    <div style="margin-top:10px;">
                    </div>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for student names..">
                    <div id="printableArea">
                        <center><h4>Taviyani Driving School Record Sheet</h4></center>
                        <table id="taxi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>                            
                                        <th>Name</th>
                                        <th>ID Card</th>
                                        <th>Phone</th>
                                        <th>Category</th>
                                        <th>Instructor</th>
                                        <th>Remarks</th>
                                        <th>Driving Test</th>
                                        <th>Theory Test</th>
                                        <th>Joined on</th>
                                        <th>Registered By</th>
                                        <th class="noprint">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td class="verticalAlign">{{ $student->name }}</th>
                                        <td class="verticalAlign">{{ $student->id_card }}</td>
                                        <td class="verticalAlign">{{ $student->phone }}</td>
                                        <td class="verticalAlign">{{ $student->category }}</td>
                                        <td class="verticalAlign">{{ $student->instructor }}</td>
                                        <td class="verticalAlign">{{ $student->remarks }}</td>
                                        <td class="verticalAlign">{{ $student->finisheddate }}</td>
                                        <td class="verticalAlign">{{ $student->theorydate }}</td>
                                        <td class="verticalAlign">{{ $student->created_at->toFormattedDateString() }}</td>
                                        <td class="verticalAlign">{{ $student->user->name }}</td>
                                        <td class="noprint">
                                            <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/students/{{ $student->id }}/edit">Edit</a>
                                            <a style="margin:1px" class="btn btn-success" href="{{ url()->current() }}/students/{{ $student->id }}">Reciept</a>
                                        </td>
                                    </tr>                            
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
            </div> 
        </div>
    </div>        
</div>                



@endsection
@section('js')
<script>
        function myFunction() {
          // Declare variables 
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("taxi");
          tr = table.getElementsByTagName("tr");
        
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            } 
          }
        }
        </script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
            
                document.body.innerHTML = printContents;
            
                window.print();
            
                document.body.innerHTML = originalContents;
            }

            function excelGen() {
                $("#printableArea").table2excel({
                    exclude: ".excludeThisClass",
                    name: "TDS RECORDS 2018 ",
                    filename: "TDS_RECORDSHEET_2018.xls" 
                });
            }
        </script>
        <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
@endsection

@section('css')

<style>

    #myInput {
        background-image: url('/searchicon.png');
        background-position: 10px 12px; 
        background-repeat: no-repeat; 
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px; 
        border: 1px solid #ddd; 
        margin-bottom: 12px; 
    }
    
    .verticalAlign {
        vertical-align: middle !important;
    }
        
    /* Print styling */
    @media print {
        [class*="col-sm-"] {
            float: left;
    }
        [class*="col-xs-"] {
            float: left;
    }
        .col-sm-12, .col-xs-12 {
            width:100% !important;
    }
        .col-sm-11, .col-xs-11 {
            width:91.66666667% !important;
    }
        .col-sm-10, .col-xs-10 {
            width:83.33333333% !important;
    }
        .col-sm-9, .col-xs-9 {
            width:75% !important;
    }
        .col-sm-8, .col-xs-8 {
            width:66.66666667% !important;
    }
        .col-sm-7, .col-xs-7 {
            width:58.33333333% !important;
    }
        .col-sm-6, .col-xs-6 {
            width:50% !important;
    }
        .col-sm-5, .col-xs-5 {
            width:41.66666667% !important;
    }
        .col-sm-4, .col-xs-4 {
            width:33.33333333% !important;
    }
        .col-sm-3, .col-xs-3 {
            width:25% !important;
    }
        .col-sm-2, .col-xs-2 {
            width:16.66666667% !important;
    }
        .col-sm-1, .col-xs-1 {
            width:8.33333333% !important;
    }
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
            float: left !important;
    }
        body {
            margin: 0;
            padding: 0 !important;
            min-width: 768px;
    }
        .container {
            width: auto;
            min-width: 750px;
    }
        body {
            font-size: 10px;
    }
        a[href]:after {
            content: none;
    }
        .noprint, div.alert, header, .group-media, .btn, .footer, form, #comments, .nav, ul.links.list-inline, ul.action-links {
            display:none !important;
    }
    }

</style>    

@endsection