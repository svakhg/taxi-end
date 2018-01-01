@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/taxi') }}">Taxi</a></li>
    <li class="active">Taxi View</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Unpaid Fee</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
              <table class="table table-striped">
                  <thead>
                        <th>#</th>
                        <th>Call Code</th>
                        <th>Taxi Number</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Collected By</th>
                  </thead>
                  <tbody>
                    @foreach ($unpaids as $unpaid)
                        <td>{{ $unpaid->id }}</td>
                        <td>{{ $unpaid->taxi_id }}</td>
                        <td>{{ $unpaid->taxi_id }}</td>
                        <td>{{ $unpaid->month }}</td>
                        <td>{{ $unpaid->year }}</td>
                    <td></td>
                    @endforeach
                  </tbody>
              </table>
            </div> 
            
        </div>
    </div>        
</div>
@endsection