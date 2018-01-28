@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School Registration</a></li>
    <li><a href="{{ url('driving-school/create') }}" class="active">Add</a></li>
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
                <form method="POST" enctype="multipart/form-data" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="driverName">Driver Name</label>
                    <input type="text" class="form-control" id="driverName" name="driverName">
                    </div>
                    <div class="form-group">
                    <label for="driverIdNo">Driver ID Number</label>
                    <input type="text" class="form-control" name="driverIdNo" id="driverIdNo" >
                    </div>
                    <div class="form-group">
                    <label for="driverTempAdd">Driver Temperory Address</label>
                    <input type="text" class="form-control" name="driverTempAdd" id="driverTempAdd" >
                    </div>
                    <div class="form-group">
                    <label for="driverPermAdd">Driver Permanant Address</label>
                    <input type="text" class="form-control" name="driverPermAdd" id="driverPermAdd" >
                    </div>
                    <div class="form-group">
                    <label for="driverMobile">Driver Mobile</label>
                    <input type="text" class="form-control" name="driverMobile" id="driverMobile" >
                    </div>
                    <div class="form-group">
                    <label for="driverEmail">Driver Email</label>
                    <input type="text" class="form-control" name="driverEmail" id="driverEmail" >
                    </div>
                    <div class="form-group">
                    <label for="driverLicenceNo">Driver Licence Number</label>
                    <input type="text" class="form-control" name="driverLicenceNo" id="driverLicenceNo" >
                    </div>
                    <div class="form-group">
                    <label for="driverLicenceExp">Driver Licence Expiry</label>
                    <input type="date" class="form-control" name="taxiOwnerMobile" id="taxiOwnerMobile" >
                    </div>
                    <div class="form-group">
                    <label for="driverPermitNo">Driver Permit No</label>
                    <input type="text" class="form-control" name="driverPermitNo" id="driverPermitNo" >
                    </div>
                    <div class="form-group">
                    <label for="driverPermitExp">Driver Permit Expiry</label>
                    <input type="date" class="form-control" name="driverPermitExp" id="driverPermitExp" >
                    </div>   
                    <div class="form-group">
                    <label for="li_front_url">Licence Front Photo</label>
                    <input type="file" class="form-control" name="li_front_url" id="li_front_url"  >
                    </div>
                    <div class="form-group">
                    <label for="li_back_url">Licence Back Photo</label>
                    <input type="file" class="form-control" name="li_back_url" id="li_back_url"  >
                    </div>
                    <div class="form-group">
                    <label for="driver_photo_url">Driver Photo</label>
                    <input type="file" class="form-control" name="driver_photo_url" id="driver_photo_url"  >
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