@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Welcome To Taviyani Admin Portal
                </div>
                <div class="panel-body" style="font-size: 15px;">
                    <p>You are logged in <strong>{{ Auth::user()->name }}</strong> !</p>
                    <p><div id="todaysDate"></div></p>
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

                        var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                        var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

                        var now = new Date();

                        str += "Today is: <strong>" + days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " " + addZero(now.getHours()) +":" + addZero(now.getMinutes()) + ":" + addZero(now.getSeconds()) + '</strong>';
                        document.getElementById("todaysDate").innerHTML = str;
                    }

                    setInterval(updateDate, 1000);
                    updateDate();
                    </script>
                    <p>-Taviyani-</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
