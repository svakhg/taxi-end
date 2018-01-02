<?php
    function randomColor() {
        $colors = ['green', 'red', 'purple', 'green'];
        $randIndex = array_rand($colors);
        return $colors[$randIndex];
    }
    function checkColor($state, $feeDate, $roadDate, $insDate) {
        $paid = ($state == '1') ? true : false;
        $feeExpired = (strtotime($feeDate) > time()) ? true : false;
        $roadExpired = (strtotime($roadDate) > time()) ? true : false;
        $insuranceExpired = (strtotime($insDate) > time()) ? true : false;
        // dd($feeDate, $paid, $feeExpired, $roadExpired, $insuranceExpired);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display Demo</title>

    <!-- Styles and Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/display.css">
    
</head>
<body>
    <div id="app">
        <div class="container">
            <center>
                <h1>{{ $title }}
                    <button class="btn btn-info">All</button>
                    <button class="btn btn-success">Paid</button>
                    <button class="btn btn-danger">Unpaid</button>
                    <button class="btn purple">Expired</button> 
                </h1>
            </center>
        </div>
        <div class="row no-gutters">
            @foreach ($taxis as $taxi)
                <div class="col-md-1">
                    <?php $color = checkColor($taxi->state, $taxi->anualFeeExpiry, $taxi->roadWorthinessExpiry, $taxi->insuranceExpiry) ?>
                    <div class="box {{ $color }}">
                        <div class="callCode circle {{ $color }}-color">{{ $taxi->callcode->callCode }}</div>
                        <div class="taxiNo">{{ $taxi->taxiNo }}</div>
                        <div class="phoneNumber">{{ $taxi->driver->driverMobile }}</div>
                    </div>
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