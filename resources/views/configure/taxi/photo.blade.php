@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/taxi') }}">Taxi</a></li>
    <li class="active">Photos</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Taxi Photos</h3>
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
                    <div class="col-md-6">
                        <h5>Taxi front</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($taxi->taxi_front_url_o) }}" class="img-thumbnail img-responsive" alt="Taxi Front Image" width="100%"
                        @if ($taxi->taxi_front_url_o == null)
                        height="300px"
                        @endif
                        >
                        <a type="button" class="btn btn-large btn-block btn-danger disabled" disabled>Delete</a>
                        <hr>
                        <center>
                            <form action="/image-upload/taxi_front/{{ $taxi->id }}" method="POST" class="form-inline" role="form">
                                <h5>Upload new Image</h5>
                                <input type="file" name="image" id="image-{{ $taxi->id }}">
                                <br>
                                <button type="submit" class="btn btn-large btn-block btn-success disabled" disabled>Submit</button>
                            </form>
                        </center>
                    </div>
                    <div class="col-md-6">
                        <h5>Taxi back</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($taxi->taxi_back_url_o) }}" class="img-thumbnail img-responsive" alt="Taxi Back Image" width="100%"
                        @if ($taxi->taxi_back_url_o == null)
                        height="300px"
                        @endif
                        >
                        <a type="button" class="btn btn-large btn-block btn-danger disabled" disabled>Delete</a>
                        <hr>
                        <center>
                            <form action="/image-upload/taxi_back/{{ $taxi->id }}" method="POST" class="form-inline" role="form">
                                <h5>Upload new Image</h5>
                                <input type="file" name="image" id="image--{{ $taxi->id }}">
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