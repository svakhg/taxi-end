@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School Registration</a></li>
    <li><a href="{{ url('driving-school/create') }}" class="active">Add</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Taxi</h3>
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
                        <label>Callcode</label>
                        <select class="form-control">
                            @foreach ($callcodes as $callcode)
                                <option value="{{ $callcode->id }}">{{ $callcode->full_callcode }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="taxiNo">Taxi Number</label>
                        <input type="text" class="form-control" id="taxiNo" name="taxiNo">
                    </div>
                    <div class="form-group">
                        <label for="taxiChasisNo">Taxi Chasis Number</label>
                        <input type="text" class="form-control" name="taxiChasisNo" id="taxiChasisNo" >
                    </div>
                    <div class="form-group">
                        <label for="taxiEngineNo">Taxi Engine Number</label>
                        <input type="text" class="form-control" name="taxiEngineNo" id="taxiEngineNo" >
                    </div>
                    <div class="form-group">
                        <label for="taxiBrand">Taxi Brand</label>
                        <input type="text" class="form-control" name="taxiBrand" id="taxiBrand" >
                    </div>
                    <div class="form-group">
                        <label for="taxiModel">Taxi Model</label>
                        <input type="text" class="form-control" name="taxiModel" id="taxiModel" >
                    </div>
                    <div class="form-group">
                        <label for="taxiColor">Taxi Color</label>
                        <input type="text" class="form-control" name="taxiColor" id="taxiColor" >
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerName">Taxi Owner Name</label>
                        <input type="text" class="form-control" name="taxiOwnerName" id="taxiOwnerName" >
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerMobile">Taxi Owner Mobile</label>
                        <input type="text" class="form-control" name="taxiOwnerMobile" id="taxiOwnerMobile" >
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerEmail">Taxi Owner Email</label>
                        <input type="text" class="form-control" name="taxiOwnerEmail" id="taxiOwnerEmail" >
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerAddress">Taxi Owner Address</label>
                        <input type="text" class="form-control" name="taxiOwnerAddress" id="taxiOwnerAddress" >
                    </div>   
                    <div class="form-group">
                        <label for="registeredDate">Registered Date</label>
                        <input type="date" class="form-control" name="registeredDate" id="registeredDate"  >
                    </div>
                    <div class="form-group">
                        <label for="annualFeeExpiry">Annual Fee Expiry</label>
                        <input type="date" class="form-control" name="annualFeeExpiry" id="annualFeeExpiry"  >
                    </div>
                    <div class="form-group">
                        <label for="roadWorthinessExpiry">Road Worthiness Expiry</label>
                        <input type="date" class="form-control" name="roadWorthinessExpiry" id="roadWorthinessExpiry"  >
                    </div>
                    <div class="form-group">
                        <label for="insuranceExpiry">Insurance Expiry</label>
                        <input type="date" class="form-control" name="insuranceExpiry" id="insuranceExpiry"  >
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate"  >
                    </div>
                    <div class="form-group">
                        <label for="taxi_front_url">Taxi Front Photo</label>
                        <input type="file" class="form-control" name="taxi_front_url" id="taxi_front_url"  >
                    </div>
                    <div class="form-group">
                        <label for="taxi_back_url">Taxi Back Photo</label>
                        <input type="file" class="form-control" name="taxi_back_url" id="taxi_back_url"  >
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