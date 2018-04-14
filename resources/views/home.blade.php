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
                    <p>-Taviyani-</p>
                    <hr>
                    <form action="{{ url('/flash-message') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="message">Flash Message:</label>
                            <input type="text" class="form-control" id="message" name="message"
                            @if ($flashmessage)
                                value="{{ $flashmessage->message }}"
                            @endif
                            >
                        </div>
                        <button type="submit" class="btn btn-default btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Last Joined Student
                </div>
                <div class="panel-body" style="font-size: 15px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Last paid taxi fee
                </div>
                <div class="panel-body" style="font-size: 15px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
@endsection