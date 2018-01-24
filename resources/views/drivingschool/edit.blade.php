@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School Registration</a></li>
    <li><a href="{{ url('driving-school/create') }}" class="active">Add</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Driving School Registration Edit</h3>
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
                <form method="POST" enctype="multipart/form-data" action="edit">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                    <label for="id_card">ID Card Number</label>
                    <input type="text" class="form-control" name="id_card" id="id_card" value="{{ $student->id_card }}">
                    </div>
                    <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $student->phone }}" >
                    </div>
                    <div class="form-group">
                        <label for="c_address">Current Address</label>
                        <input type="text" class="form-control" name="c_address" id="c_address" value="{{ $student->c_address }}" >
                    </div>
                    <div class="form-group">
                        <label for="p_address">Permanent Address</label>
                        <input type="text" class="form-control" name="p_address" id="p_address" value="{{ $student->p_address }}" >
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate" value="{{ $student->rate }}" >
                    </div>
                    <div class="form-group">
                            <label for="finisheddate">Finshed Date</label>
                            <input type="text" class="form-control" name="finisheddate" id="finisheddate" value="{{ $student->finisheddate }}" >
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