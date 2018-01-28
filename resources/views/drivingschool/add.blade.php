@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School Registration</a></li>
    <li><a href="{{ url('driving-school/create') }}" class="active">Add</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Driving School Registration</h3>
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
                <form method="POST" enctype="multipart/form-data" action="create/success">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                    <label for="id_card">ID Card Number</label>
                    <input type="text" class="form-control" name="id_card" id="id_card" >
                    </div>
                    <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone"  >
                    </div>
                    <div class="form-group">
                        <label for="phone">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option >Select Catergory</option>
                            <option value="A1">A1 / A0 - Cycle</option>
                            <option value="B1">B1 - Car</option>
                            <option value="B2">B2</option>
                            <option value="C1">C1 - Pickup</option>
                            <option value="C2">C2</option>
                            <option value="CO">CO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="c_address">Current Address</label>
                        <input type="text" class="form-control" name="c_address" id="c_address"  >
                    </div>
                    <div class="form-group">
                        <label for="p_address">Permanent Address</label>
                        <input type="text" class="form-control" name="p_address" id="p_address"  >
                    </div>
                    <div class="form-group">
                        <label for="phone">Instructor</label>
                        <select class="form-control" id="instructor" name="instructor" required>
                            <option >Select Instructor</option>
                            <option value="Nadheem">Nadeem</option>
                            <option value="Hussain">Hussain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate"  >
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <select class="form-control" id="remarks" name="remarks" required>
                            <option >Select Remarks</option>
                            <option value="Form Processed">Form Processed</option>
                            <option value="Card Issued">Card Issued</option>
                            <option value="Finished">Finished</option>
                            <option value="Not Coming">Not Coming</option>
                            <option value="Couldn't Contact">Couldn't Contact</option>
                            <option value="Refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="finisheddate">Driving Test Date</label>
                        <input type="text" class="form-control" name="finisheddate" id="finisheddate"  >
                    </div>
                    <div class="form-group">
                        <label for="theorydate">Theory Test Date</label>
                        <input type="text" class="form-control" name="theorydate" id="theorydate"  >
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