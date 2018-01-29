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
    
</head>
<body>
    <div id="app">
        <div class="container-fluid">
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
                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6" data-toggle="modal" data-target="#driverDetail"
                @if ($taxi->driver)
                    onclick="driverModal('{{ $taxi->driver->id }}')"
                @else
                    onclick="console.log('No Driver')"
                @endif
                >
                    <?php $color = checkColor($taxi->state, $taxi->anualFeeExpiry, $taxi->roadWorthinessExpiry, $taxi->insuranceExpiry) ?>
                    @if (checkStatus(request()->status, $color))
                        <div class="box {{ $color }}">
                            <div class="callCode circle {{ $color }}-color">
                                {{ $taxi->callcode->callCode }}
                            </div>
                            <div class="taxiNo" style = "margin-left:1.2cm;">
                                {{ $taxi->taxiNo }}
                            </div>
                            <div class="phoneNumber">
                                @if ($taxi->driver)
                                    {{ $taxi->driver->driverMobile }}
                                @else
                                    No driver
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
                    <h5 class="modal-title">Driver Detail</h5>
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
                            <h5>Driver Phone: <span id="driverPhone"></span></h5>
                            <h5>Id card: <span id="driverId"></span></h5>
                            <h5>Driver Temp. Address: <span id="driverTempAdd"></span></h5>
                            <h5>Driver Perm. Address: <span id="driverPermAdd"></span></h5>
                            <h5>Driver Email: <span id="driverEmail"></span></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <center>
                                <h5 id="paymentStatus"></h5>
                                <h5>Anual Fee expiry: <span id="annualFee"></span></h5>
                                <h5>Road Worthiness expiry: <span id="roadWorthiness"></span></h5>
                                <h5>Insurance expiry: <span id="insuranceExpiry"></span></h5>
                            </center>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h5>Driver License No. <span id="driverLicenceNo"></span> - Driver License expiry: <span id="driverLicenceExp"></span></h5>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img id="licenceFront" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <img id="licenceBack" class="img-fluid img-thumbnail" src="http://graphics8.nytimes.com/packages/images/multimedia/bundles/projects/2013/Licenses/2008back.jpg" alt="">
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
    <script>
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
                    $('#driverName').text(result.driverName);
                    $('#driverPhone').text(result.driverMobile);
                    $('#driverId').text(result.driverIdNo);
                    $('#driverTempAdd').text(result.driverTempAdd);
                    $('#driverPermAdd').text(result.driverPermAdd);
                    $('#driverEmail').text(result.driverEmail);
                    $('#driverLicenceNo').text(result.driverLicenceNo);
                    $('#driverLicenceExp').text(result.driverLicenceExp);
                    $('#driverPhoto').attr("src", driverPhoto);
                    $('#licenceFront').attr("src", licenceFront);
                    $('#licenceBack').attr("src", licenceBack);
                    $('#driverLicenceExp').text(result.driverLicenceExp);

                    $('#annualFee').text(result.taxi.anualFeeExpiry);
                    $('#roadWorthiness').text(result.taxi.roadWorthinessExpiry);
                    $('#insuranceExpiry').text(result.taxi.insuranceExpiry);
                }
            });
        }
    </script>
</body>
</html>