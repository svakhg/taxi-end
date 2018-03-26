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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/display.css">
    <style>
        .marquee {
            width: 100%;
            overflow: hidden;
            margin-bottom: 10px;
            font-weigh: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title">{{ $title }}</h1>
                </div>
                <div class="col-md-6">
                    <div class="buttons">
                        <a href="{{ url()->current() }}" class="btn btn-info">All</a>
                        <a href="{{ url()->current() }}?status=paid"  class="btn btn-success">Paid</a>
                        <a href="{{ url()->current() }}?status=unpaid"  class="btn btn-danger">Unpaid</a>
                        <a href="{{ url()->current() }}?status=expired"  class="btn purple">Expired</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="marquee">{{ $flashmessage->message }}</div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            @foreach ($taxis as $taxi)
                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6" data-toggle="modal" data-target="#driverDetail"
                @if ($taxi->driver)
                    onclick="driverModal('{{ $taxi->driver->id }}')"
                @endif
                >
                    <?php $color = checkColor($taxi->state, $taxi->anualFeeExpiry, $taxi->roadWorthinessExpiry, $taxi->insuranceExpiry) ?>
                    @if (checkStatus(request()->status, $color))
                        <div class="box {{ $color }}">
                            <div class="callCode circle {{ $color }}-color">
                                {{ $taxi->callcode->callCode }}
                            </div>
                            <div class="taxiNo">
                                {{ $taxi->taxiNo }}
                            </div>
                            <div class="phoneNumber">
                                @if ($taxi->driver)
                                    {{ $taxi->driver->driverMobile }}
                                @else
                                    No Number
                                @endif
                            </div>
                        </div>
                    @endif   
                </div>    
            @endforeach
        </div>
    </div>
    

    <div id="driverDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Driver Detail" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: black" class="modal-title">Driver Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    <div class="row">
                        <div class="col-md-3">
                            <img id="driverPhoto" class="img-fluid img-thumbnail" src="https://profile.actionsprout.com/default.jpeg">
                        </div>
                        <div class="col">
                            <h3>Name: <span id="driverName"></span></h3>
                            <h5>Id card: <span id="driverId"></span></h5>
                            <h5>Driver License No. <span id="driverLicenceNo"></span></h5>
                            <h5>Driver Temp. Address: <span id="driverTempAdd"></span></h5>
                            <h5>Driver Perm. Address: <span id="driverPermAdd"></span></h5>
                            <h5>Driver Phone: <span id="driverPhone"></span></h5>
                            <h5>Driver Email: <span id="driverEmail"></span></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h3>BIA <span id="taxiNumber"></span></h3>
                            <h5 id="paymentStatus"></h5>
                            <h5>Anual Fee expiry: <span id="annualFee"></span></h5>
                            <h5>Road Worthiness expiry: <span id="roadWorthiness"></span></h5>
                            <h5>Insurance expiry: <span id="insuranceExpiry"></span></h5>
                            <h5>Driver License expiry: <span id="driverLicenceExp"></span></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>License Card</h5>
                            <img id="licenceFront" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Taxi Permit</h5>
                            <img id="licenceBack" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Taxi Front</h5>
                            <img id="taxiFront" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Taxi Back</h5>
                            <img id="taxiBack" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="hidden_view" id="hidden_view" value="{{ url('api/driver') }}">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/js/display.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
    <script>
        function checkDate(date) {
            var selectedDate = new Date(date);
            var now = new Date();
            now.setHours(0,0,0,0);
            if (selectedDate < now) {
                console.log("Selected date is in the past");                
                return false;
            } else {
                console.log("Selected date is NOT in the past");
                return true;
            }
        }

        function driverModal(id) {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type:"GET", 
                data: {"id":id}, 
                success: function(result) {
                    console.log(result);
                    var driverPhoto = 'https://s3-ap-southeast-1.amazonaws.com/taviyani/' + result.driver_photo_url_t;
                    var licenceFront = 'https://s3-ap-southeast-1.amazonaws.com/taviyani/' + result.li_front_url_t;
                    var licenceBack = 'https://s3-ap-southeast-1.amazonaws.com/taviyani/' + result.li_back_url_t;

                    var taxiFront = 'https://s3-ap-southeast-1.amazonaws.com/taviyani/' + result.taxi.taxi_front_url_o;
                    var taxiBack = 'https://s3-ap-southeast-1.amazonaws.com/taviyani/' + result.taxi.taxi_back_url_o;

                    $('#driverName').text(result.driverName);
                    $('#driverPhone').text(result.driverMobile);
                    $('#driverId').text(result.driverIdNo);
                    $('#driverTempAdd').text(result.driverTempAdd);
                    $('#driverPermAdd').text(result.driverPermAdd);
                    $('#driverEmail').text(result.driverEmail);
                    $('#driverLicenceNo').text(result.driverLicenceNo);
                    $('#taxiNumber').text(result.taxi.taxiNo);

                    $('#driverPhoto').attr("src", driverPhoto);
                    $('#licenceFront').attr("src", licenceFront);
                    $('#licenceBack').attr("src", licenceBack);
                    

                    $('#taxiFront').attr("src", taxiFront);
                    $('#taxiBack').attr("src", taxiBack);

                    if (checkDate(result.taxi.anualFeeExpiry) == true) {
                        $('#annualFee').addClass('green-color').text(result.taxi.anualFeeExpiry);
                    } else {
                        $('#annualFee').addClass('red-color').text(result.taxi.anualFeeExpiry);
                    }
                    
                    if (checkDate(result.taxi.roadWorthinessExpiry) == true) {
                        $('#roadWorthiness').addClass('green-color').text(result.taxi.roadWorthinessExpiry);
                    } else {
                        $('#roadWorthiness').addClass('red-color').text(result.taxi.roadWorthinessExpiry);
                    }

                    if (checkDate(result.taxi.insuranceExpiry) == true) {
                        $('#insuranceExpiry').addClass('green-color').text(result.taxi.insuranceExpiry);
                    } else {
                        $('#insuranceExpiry').addClass('red-color').text(result.taxi.insuranceExpiry);
                    }

                    if (checkDate(result.driverLicenceExp) == true) {
                        $('#driverLicenceExp').addClass('green-color').text(result.driverLicenceExp);
                    } else {
                        $('#driverLicenceExp').addClass('red-color').text(result.driverLicenceExp);
                    }

                }
            });
        }


        $('.marquee').marquee({
            duration: 10000,
        });
    </script>
</body>
</html>