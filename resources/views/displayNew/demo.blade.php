<?php
    function randomColor() {
        $colors = ['green', 'red', 'purple', 'green'];
        $randIndex = array_rand($colors);
        return $colors[$randIndex];
    }

    function randomTaxiNumber() {
        return mt_rand(1000,9999);
    }

    function randomPhoneNumber() {
        $number = ['9', '7'];
        $randIndex = array_rand($number);
        // Comment to push to git
        return $number[$randIndex].mt_rand(100000,999999);
    }

    function randomCompany() {
        $company = ['JR Taxi - 1919', 'City Cab - 1313', 'Cycle Taxi - 6090'];
        $randIndex = array_rand($company);
        return $company[$randIndex];
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
    <title>Display Demo</title>

    <!-- Styles and Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/display.css">
    
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h1 class="title">{{ randomCompany() }}</h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="buttons">
                        <a href="{{ url('display-demo') }}" class="btn btn-info">All</a>
                        <a href="{{ url('display-demo') }}?status=paid"  class="btn btn-success">Paid</a>
                        <a href="{{ url('display-demo') }}?status=unpaid"  class="btn btn-danger">Unpaid</a>
                        <a href="{{ url('display-demo') }}?status=expired"  class="btn purple">Expired</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            @for ($i = 0; $i < 150; $i++)
                <?php $color = randomColor() ?>
                @if (checkStatus(request()->status, $color))
                    <div class="col-lg-1 col-md-2 col-sm-6 col-xs-1">
                        <div class="box {{ $color }}">
                            <div class="callCode circle {{ $color }}-color">{{ $i + 1 }}</div>
                            <div class="taxiNo">{{ randomTaxiNumber() }}</div>
                            <div class="phoneNumber">{{ randomPhoneNumber() }}</div>
                        </div>
                    </div>
                @endif   
            @endfor
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="/js/display.js"></script>
</body>
</html>