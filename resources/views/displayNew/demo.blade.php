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
        <div class="row no-gutters">
            @for ($i = 0; $i < 150; $i++)
                <div class="col-md-1">
                    <div class="box {{ randomColor() }}">
                        <div class="taxiNo">T-{{ randomTaxiNumber() }}</div>
                        <div class="callCode">CC: {{ $i + 1 }}</div>
                        <div class="phoneNumber">{{ randomPhoneNumber() }}</div>
                    </div>
                </div>    
            @endfor
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="/js/display.js"></script>
</body>
</html>