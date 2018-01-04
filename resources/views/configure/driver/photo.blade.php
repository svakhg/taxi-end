@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/driver') }}">Driver</a></li>
    <li class="active">Photos</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Driver Photos</h3>
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
                <div class="row">
                    <div class="col-md-4">
                        <h5>Driver Photo</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($driver->driver_photo_url_o) }}" class="img-thumbnail img-responsive" alt="Driver Image" width="100%"
                        @if ($driver->driver_photo_url_o == null)
                        height="300px"
                        @endif
                        >
                        <a type="button" class="btn btn-large btn-block btn-danger disabled" disabled>Delete</a>
                        <hr>
                        <center>
                            <form action="/image-upload/driver_photo/{{ $driver->id }}" method="POST" class="form-inline" role="form">
                                <h5>Upload new Image</h5>
                                <input type="file" name="image" id="image---{{ $driver->id }}"  disabled>
                                <br>
                                <button type="submit" class="btn btn-large btn-block btn-success disabled" disabled>Submit</button>
                            </form>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <h5>Licence front</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($driver->li_front_url_o) }}" class="img-thumbnail img-responsive" alt="Driver License Front Image" width="100%"
                        @if ($driver->li_front_url_o == null)
                        height="300px"
                        @endif
                        >
                        <a type="button" class="btn btn-large btn-block btn-danger disabled" disabled>Delete</a>
                        <hr>
                        <center>
                            <form action="/image-upload/li_front/{{ $driver->id }}" method="POST" class="form-inline" role="form">
                                <h5>Upload new Image</h5>
                                <input type="file" name="image" id="image{{ $driver->id }}" disabled>
                                <br>
                                <button type="submit" class="btn btn-large btn-block btn-success disabled" disabled>Submit</button>
                            </form>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <h5>Licence back</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($driver->li_back_url_o) }}" class="img-thumbnail img-responsive" alt="Driver License Back Image" width="100%"
                        @if ($driver->li_back_url_o == null)
                        height="300px"
                        @endif
                        >
                        <a type="button" class="btn btn-large btn-block btn-danger disabled" disabled>Delete</a>
                        <hr>
                        <center>
                            <form action="/image-upload/li_back/{{ $driver->id }}" method="POST" class="form-inline" role="form">
                                <h5>Upload new Image</h5>
                                <input type="file" name="image" id="image--{{ $driver->id }}" disabled>
                                <br>
                                <button type="submit" class="btn btn-large btn-block btn-success disabled" disabled>Submit</button>
                            </form>
                        </center>
                    </div>
                </div>
                <hr>
            </div> 
        </div>
    </div>        
</div>
@endsection