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
                        <select name="callcode_id" class="form-control">
                            @foreach ($callcodes as $callcode)
                                <option value="{{ $callcode->id }}">{{ $callcode->full_callcode }}</option>
                            @endforeach
                                <option value="{{ $taxi->callcode->id }}" selected>{{ $taxi->callcode->full_callcode }}</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="taxiNo">Taxi Number</label>
                        <input type="text" class="form-control" id="taxiNo" name="taxiNo" value="{{ $taxi->taxiNo }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiChasisNo">Taxi Chasis Number</label>
                        <input type="text" class="form-control" name="taxiChasisNo" id="taxiChasisNo" value="{{ $taxi->taxiChasisNo }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiEngineNo">Taxi Engine Number</label>
                        <input type="text" class="form-control" name="taxiEngineNo" id="taxiEngineNo" value="{{ $taxi->taxiEngineNo }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiBrand">Taxi Brand</label>
                        <input type="text" class="form-control" name="taxiBrand" id="taxiBrand" value="{{ $taxi->taxiBrand }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiModel">Taxi Model</label>
                        <input type="text" class="form-control" name="taxiModel" id="taxiModel" value="{{ $taxi->taxiModel }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiColor">Taxi Color</label>
                        <input type="text" class="form-control" name="taxiColor" id="taxiColor" value="{{ $taxi->taxiColor }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerName">Taxi Owner Name</label>
                        <input type="text" class="form-control" name="taxiOwnerName" id="taxiOwnerName" value="{{ $taxi->taxiOwnerName }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerMobile">Taxi Owner Mobile</label>
                        <input type="text" class="form-control" name="taxiOwnerMobile" id="taxiOwnerMobile" value="{{ $taxi->taxiOwnerMobile }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerEmail">Taxi Owner Email</label>
                        <input type="text" class="form-control" name="taxiOwnerEmail" id="taxiOwnerEmail" value="{{ $taxi->taxiOwnerEmail }}">
                    </div>
                    <div class="form-group">
                        <label for="taxiOwnerAddress">Taxi Owner Address</label>
                        <input type="text" class="form-control" name="taxiOwnerAddress" id="taxiOwnerAddress" value="{{ $taxi->taxiOwnerAddress }}">
                    </div>   
                    <div class="form-group">
                        <label for="registeredDate">Registered Date</label>
                        <input type="date" class="form-control" name="registeredDate" id="registeredDate" value="{{ $taxi->registeredDate }}">
                    </div>
                    <div class="form-group">
                        <label for="anualFeeExpiry">Annual Fee Expiry</label>
                        <input type="date" class="form-control" name="anualFeeExpiry" id="anualFeeExpiry " value="{{ $taxi->anualFeeExpiry }}">
                    </div>
                    <div class="form-group">
                        <label for="roadWorthinessExpiry">Road Worthiness Expiry</label>
                        <input type="date" class="form-control" name="roadWorthinessExpiry" id="roadWorthinessExpiry" value="{{ $taxi->roadWorthinessExpiry }}">
                    </div>
                    <div class="form-group">
                        <label for="insuranceExpiry">Insurance Expiry</label>
                        <input type="date" class="form-control" name="insuranceExpiry" id="insuranceExpiry" value="{{ $taxi->insuranceExpiry }}">
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate" value="{{ $taxi->rate }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div> 
        </div>
        
    </div>        
</div>
@endsection