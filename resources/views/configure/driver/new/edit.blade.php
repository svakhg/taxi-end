@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/driver') }}">Driver</a></li>
    <li class="active">Add</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Driver</h3>
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
                <form method="POST" enctype="multipart/form-data" action="{{ url()->current() }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Taxi</label>
                        <select name="taxi_id" class="form-control">
                            @foreach ($taxis as $taxi)
                                <option value="{{ $taxi->id }}"
                                @if ($taxi->id == $driver->taxi_id)
                                selected
                                @endif    
                                >{{ $taxi->full_taxi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="driverName">Driver Name</label>
                        <input type="text" class="form-control" id="driverName" name="driverName" value="{{ $driver->driverName }}">
                    </div>
                    <div class="form-group">
                        <label for="driverIdNo">Driver ID Number</label>
                        <input type="text" class="form-control" name="driverIdNo" id="driverIdNo" value="{{ $driver->driverIdNo }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverTempAdd">Driver Temperory Address</label>
                        <input type="text" class="form-control" name="driverTempAdd" id="driverTempAdd" value="{{ $driver->driverTempAdd }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverPermAdd">Driver Permanant Address</label>
                        <input type="text" class="form-control" name="driverPermAdd" id="driverPermAdd" value="{{ $driver->driverPermAdd }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverMobile">Driver Mobile</label>
                        <input type="text" class="form-control" name="driverMobile" id="driverMobile" value="{{ $driver->driverMobile }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverEmail">Driver Email</label>
                        <input type="text" class="form-control" name="driverEmail" id="driverEmail" value="{{ $driver->driverEmail }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverLicenceNo">Driver Licence Number</label>
                        <input type="text" class="form-control" name="driverLicenceNo" id="driverLicenceNo" value="{{ $driver->driverLicenceNo }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverLicenceExp">Driver Licence Expiry</label>
                        <input type="date" class="form-control" name="driverLicenceExp" id="driverLicenceExp" value="{{ $driver->driverLicenceExp }}">
                    </div>
                    <div class="form-group">
                        <label for="driverPermitNo">Driver Permit No</label>
                        <input type="text" class="form-control" name="driverPermitNo" id="driverPermitNo" value="{{ $driver->driverPermitNo }}" >
                    </div>
                    <div class="form-group">
                        <label for="driverPermitExp">Driver Permit Expiry</label>
                        <input type="date" class="form-control" name="driverPermitExp" id="driverPermitExp" value="{{ $driver->driverPermitExp }}">
                    </div>   
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>      
                </form>
            </div> 
        </div>
        
    </div>        
</div>
@endsection