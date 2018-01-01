@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Report</a></li>
    <li class="active">Payment History (Unpaid)</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
                <input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-success">
                <input type="button" onclick="excelGen()" value="Excel" class="btn btn-info">
                <div id="printableArea">
                    <h3>Unpaid Fee</h3>
                    <table id="printable" class="table table-bordered">
                        <thead>
                                <th>#</th>
                                <th>Call Code</th>
                                <th>Taxi Number</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Collected By</th>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($unpaids as $unpaid)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $unpaid->taxi->callcode->callCode }} - {{ $unpaid->taxi->callcode->taxicenter->name }}</td>
                                    <td>T-{{ $unpaid->taxi->taxiNo }}</td>
                                    <td>{{ date("F", $unpaid->month) }}</td>
                                    <td>{{ $unpaid->year }}</td>
                                    <td></td>
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
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
        
            document.body.innerHTML = printContents;
        
            window.print();
        
            document.body.innerHTML = originalContents;
        }

        function excelGen() {
            $("#printable").table2excel({
                exclude: ".excludeThisClass",
                name: "Unpaid Fees",
                filename: "unpaid_generation.xls" 
            });
        }
    </script>

    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
@endsection

@section('css')

<style>
        
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