<!doctype html>
<html lang='en'>
<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Taxi Payment</title>

    <style>
        .doubleline {
            padding: 1px 0;
            border-bottom: solid 0.180em #000;
            font-weight: bold;
            position: relative;
            margin-bottom: 6px;
        }
        .doubleline:after {
            content: '';
            border-bottom: solid 0.180em #000;
            width: 100%;
            position: absolute;
            bottom: -3px;
            left: 0;   
        }
    </style>
</head>

<body>
        <?php
        $monthNum = $payment->month;
        $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
        ?>
    <br>
    <div class ="container" id="printableArea">
        <table width="100%" border="0" style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:12px; ">
            <tr>
                <td width="80%">
                    <?php $logo = '/logo'.$payment->taxi->callcode->taxicenter->cCode.'.jpg' ?>
                    <img src="/logo/{{ $payment->taxi->callcode->taxicenter->cCode }}.jpg" height="70"  alt=""/>
                </td>
                <td width="20%" colspan="2" align="left">
                    <table width="100%" border="0">
                        <tr>
                            <td><strong>Date :</strong></td>
                            <td align="right">{{ Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Slip No. :</strong></td>
                            <td align="right">TPL/{{ $payment->year }}/{{ $payment->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>TIN No. :</strong></td>
                            <td align="right">{{ $payment->taxi->callcode->taxicenter->company->GSTTin }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center"><strong><span style="font-size:17px; font-weight:bold">CASH SLIP</span></strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <table width="100%" border="1" style="border-collapse:collapse">
                        <tr>
                            <td width="21%" align="center"><strong>INFO</strong></td>
                            <td width="7%" align="center"><strong>MONTH/YEAR</strong></td>
                            <td width="37%" align="center"><strong>DESCRIPTION</strong></td>
                            <td width="10%" align="center"><strong>QTY</strong></td>
                            <td width="11%" align="center"><strong>RATE</strong></td>
                            <td width="14%" align="center"><strong>TOTAL</strong></td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="doubleline" style="font-weight:normal">
                                &nbsp;T-{{ $payment->taxi->taxiNo }}<br>
                                &nbsp;Call Code: {{ $payment->taxi->callCode->full_callcode }}<br>
                                &nbsp;Driver Name: {{ $payment->taxi->driver->driverName }}<br>
                                &nbsp;A{{ $payment->taxi->driver->driverIdNo }}<br>
                                &nbsp;{{ $payment->taxi->driver->driverMobile }}<br>
                            </td>
                            <td align="center">&nbsp;{{ $monthName }}/{{ $payment->year }}</td>
                            <td>&nbsp;{{ $payment->desc }}</td>
                            <td align="center">{{ $payment->qty }}</td>
                            <td align="center">{{ $payment->total }}</td>
                            <td align="center">{{ $payment->total }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td colspan="2"  align="center">SUBTOTAL </td>
                            <td align="center" >{{ $payment->total }}</td>
                        </tr>
                        <tr>
                            <td class="doubleline">&nbsp;</td>
                            <td class="doubleline">&nbsp;</td>
                            <td colspan="2" align="center">GST 6%</td>
                            <td align="center">-</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td class="doubleline">&nbsp;&nbsp;&nbsp; Collected By :
                                {{ $payment->user->name }}
                            </td>
                            <td colspan="2" align="center" class="doubleline">TOTAL</td>
                            <td class="doubleline" align="center">{{ $payment->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" height="30px" style="border-left:0px">&nbsp;&nbsp;&nbsp;&nbsp; Follow Traffic Signals, Avoid Overtaking from Left and Avoid Cell Phones while Driving.</td>
                            <td colspan="2" align="center" class="doubleline">Time </td>
                            <td align="center" class="doubleline" id="todaysDate"></td>
                        </tr>
                        <tr>
                            <td height="36" colspan="6" align="center" style="border-top:1px solid #000"><strong>
                                Address: {{ $payment->taxi->callcode->taxicenter->address }} | Telephone: {{ $payment->taxi->callcode->taxicenter->telephone }} | Fax: {{ $payment->taxi->callcode->taxicenter->fax }} | Email: {{ $payment->taxi->callcode->taxicenter->email }} 
                                </strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>  
    <br>
   <div class= "container">
       <button class="btn btn-info" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> Print Reciept</button>
       <button class="btn btn-info" ><i class="fa fa-arrow-left" aria-hidden="true"></i></i> <a href="{{ url('/payments/taxi-payment') }}" style="color:white;">Go Back</a></button>
   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
        
            document.body.innerHTML = printContents;
        
            window.print();
        
            document.body.innerHTML = originalContents;
        }
        </script>
        <script>
            function addZero(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
    
            function updateDate()
            {
                var str = "";
    
                var now = new Date();
    
                str +=  addZero(now.getHours()) +":" + addZero(now.getMinutes()) + ":" + addZero(now.getSeconds());
                document.getElementById("todaysDate").innerHTML = str;
            }
    
            setInterval(updateDate, 1000);
            updateDate();
        </script>
</body>
</html>