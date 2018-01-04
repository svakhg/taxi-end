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
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($taxi->taxi_front_url_t) }}" class="img-thumbnail img-responsive" alt="Taxi Front Image">
                    </div>
                    <div class="col-md-6">
                        <h5>Taxi back</h5>
                        <hr>
                        <img src="{{ \App\Helpers\Helper::s3_url_gen($taxi->taxi_back_url_t) }}" class="img-thumbnail img-responsive" alt="Taxi Back Image">
                    </div>
                </div>
                <hr>
            </div> 
        </div>
    </div>        
</div>
@endsection