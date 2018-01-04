<?php
    function checkColor($state, $feeDate, $roadDate, $insDate) {
        $paid = ($state == '1') ? true : false;
        $feeExpired = (strtotime($feeDate) > time()) ? true : false;
        $roadExpired = (strtotime($roadDate) > time()) ? true : false;
        $insuranceExpired = (strtotime($insDate) > time()) ? true : false;
        // dd($paid, $feeDate, $roadDate, $insDate, $feeExpired, $roadExpired, $insuranceExpired);
        if(!$paid) {
            return 'red';
        }
        if($paid AND !$feeExpired OR !$roadExpired OR !$insuranceExpired) {
            return 'purple';
        } 
        elseif($paid AND $feeExpired AND $roadExpired AND $insuranceExpired) {
            return 'green';
        }

    }
    function checkStatus($status, $color) {
        if($status == NULL) {
            return true;
        }
        if($status == 'paid') {
            return ($color == 'green' OR $color == 'purple') ? true : false;
        }
        if($status == 'unpaid') {
            return ($color == 'red') ? true : false;
        }
        if($status == 'expired') {
            return ($color == 'purple') ? true : false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('Taviyani_Logo.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('Taviyani_Logo.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('Taviyani_Logo.png')}}">

    <title>{{ $title }}</title>

    <!-- Styles and Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/display.css">
    
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h1 class="title">{{ $title }}</h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="buttons">
                        <a href="{{ url()->current() }}" class="btn btn-info">All</a>
                        <a href="{{ url()->current() }}?status=paid"  class="btn btn-success">Paid</a>
                        <a href="{{ url()->current() }}?status=unpaid"  class="btn btn-danger">Unpaid</a>
                        <a href="{{ url()->current() }}?status=expired"  class="btn purple">Expired</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            @foreach ($taxis as $taxi)
                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6">
                    <?php $color = checkColor($taxi->state, $taxi->anualFeeExpiry, $taxi->roadWorthinessExpiry, $taxi->insuranceExpiry) ?>
                    @if (checkStatus(request()->status, $color))
                        <div class="box {{ $color }}">
                            <div class="callCode circle {{ $color }}-color">{{ $taxi->callcode->callCode }}</div>
                            <div class="taxiNo">{{ $taxi->taxiNo }}</div>
                            <div class="phoneNumber">{{ $taxi->driver->driverMobile }}</div>
                        </div>
                    @endif   
                </div>    
            @endforeach
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="/js/display.js"></script>
</body>
</html>