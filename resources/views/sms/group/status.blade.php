@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li class="active">SMS Status</li>
</ul>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Group SMS Status</h3>
            </div>
            <div class="panel-body">
                <div class="row">   
                    <div class="col-md-12">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <h6>Sender Id: {{ $groupSms->senderId }}</h6>
                            <p>Message: {{ $groupSms->message }}</p>
                            <hr>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($groupSms->numbers as $number)
                                    <tr>
                                        <td>{{ $number->phone_number }}</td>
                                        <td
                                        @if ($number->delivered == '1')
                                            class="success"
                                        @elseif ($number->delivered == '2')
                                            class="danger"
                                        @endif
                                        >{{ $number->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>        
        </div> 
    </div>
</div>

@endsection

@section('js')
    <script src="/js/sms_counter.min.js"></script>
    <script>
        $('#message').countSms('#sms-counter')
    </script>
@endsection