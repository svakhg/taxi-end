@extends('layouts.app')

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School</a></li>
    <li><a href="{{ url('driving-school') }}" class="active">All Users</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">All Driving School Students</h3>
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
                    <table id="taxi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>                            
                                    <th>Name</th>
                                    <th>ID Card</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Instructor</th>
                                    <th>Remarks</th>
                                    <th>Registered By</th>
                                    <th>Joined on</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</th>
                                    <td>{{ $student->id_card }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->category }}</td>
                                    <td>{{ $student->instructor }}</td>
                                    <td>{{ $student->remarks }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/update/">Edit</a>
                                        <a style="margin:1px" class="btn btn-info" href="{{ url()->current() }}/view/">View</a>
                                    </td>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
            </div> 
        </div>
    </div>        
</div>                



@endsection
