@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Welcome To Taviyani Admin Portal
                </div>
                <div class="panel-body">
                    You are logged in {{ Auth::user()->name }} !
<br>
<?php
date_default_timezone_set("Indian/Maldives"); 
echo "Today is " . date("Y.m.d");?> and <?php
date_default_timezone_set("Indian/Maldives");
echo "the time is " . date("h:i:sa");
?>
<br>
<br>
-Taviyani-
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
