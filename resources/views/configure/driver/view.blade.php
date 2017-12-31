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
                    <table>
                            <thead>
          
                            </thead>
                            <tbody>
                                
                            </tbody>
                    </table>
            </div> 
        </div>
        
    </div>        
</div>
@endsection