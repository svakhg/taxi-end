@extends('layouts.app')

@section('css')
    <link href="/css/dhivehi.css" rel="stylesheet">
@endsection

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('theory/view') }}">Theory</a></li>
    <li class="active">Add</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Add Questions and Answers</h3>
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
                <form action="{{ url()->current() }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="usr">Question</label>
                        <input type="text" class="dhivehi-font dhivehi-rtl form-control" name="question">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="usr">Answer 1 (Write the correct answer here)</label>
                        <input type="text" class="dhivehi-font dhivehi-rtl form-control" name="answer1">
                    </div>
                    <div class="form-group">
                        <label for="usr">Answer 2</label>
                        <input type="text" class="dhivehi-font dhivehi-rtl form-control" name="answer2">
                    </div>
                    <div class="form-group">
                        <label for="usr">Answer 3</label>
                        <input type="text" class="dhivehi-font dhivehi-rtl form-control" name="answer3">
                    </div>
                    <div class="form-group">
                        <label for="usr">Answer 4</label>
                        <input type="text" class="dhivehi-font dhivehi-rtl form-control" name="answer4">
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-success btn-block">Add</button>
                </form>
            </div> 
        </div>
        
    </div>        
</div>
@endsection