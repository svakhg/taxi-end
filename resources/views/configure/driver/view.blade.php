@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/taxi') }}">Taxi</a></li>
    <li class="active">Driver View</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Driver View</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
                <table class="table table-striped">
                        <thead>
                            <th>taxi_id</th>
                            <th>driverName</th>
                            <th>driverIdNo</th>
                            <th>driverTempAdd</th>
                            <th>driverPermAdd</th>
                            <th>driverMobile</th>
                            <th>driverEmail</th>
                            <th>driverLicenceNo</th>
                            <th>driverLicenceExp</th>
                            <th>driverPermitNo</th>
                            <th>driverPermitExp</th>
                        </thead>
                        <tbody>
                            <td>{{ $driver->taxi_id }}</td>
                            <td>{{ $driver->driverName }}</td>
                            <td>{{ $driver->driverIdNo }}</td>
                            <td>{{ $driver->driverTempAdd }}</td>
                            <td>{{ $driver->driverPermAdd }}</td>
                            <td>{{ $driver->driverMobile }}</td>
                            <td>{{ $driver->driverEmail }}</td>
                            <td>{{ $driver->driverLicenceNo }}</td>
                            <td>{{ $driver->driverLicenceExp }}</td>
                            <td>{{ $driver->driverPermitNo }}</td>
                            <td>{{ $driver->driverPermitExp }}</td>
                        </tbody>
                </table>
            </div>
            <div class="col-md-12"> 
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->li_front_url_o }}" alt="">
                <hr> 
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->li_back_url_o }}" alt=""> 
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->driver_photo_url_o }}" alt=""> 
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->li_front_url_t }}" alt=""> 
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->li_back_url_t }}" alt=""> 
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$driver->driver_photo_url_t }}" alt=""> 
                <hr>
            </div>
        </div>
    </div>        
</div>
@endsection