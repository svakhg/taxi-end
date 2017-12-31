@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li class="active">SMS</li>
</ul>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Send SMS</h3>
    </div>
    <div class="panel-body">
        <div class="row">            
            <div class="col-md-12">
                <form class="form-horizontal" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="senderId">Sender Id</label>
                            <div class="col-md-4">
                                <input id="senderId" value="Taviyani" maxlength="11" pattern="^(?=.*[a-zA-Z])(?=.*[a-zA-Z0-9])([a-zA-Z0-9 ]{1,11})$" name="senderId" type="text" placeholder="Taviyani" class="form-control input-md" required="" title="Cannot Be Loner than 11 letter. Only letters and numbers allowed" disabled>
                                <span class="help-block">Enter a sender Id here. It must be a combination of letters and numbers, It cannot be more than 11 characters.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phoneNumber">Phone Number</label>
                            <div class="col-md-4">
                                <input id="phoneNumber" name="phoneNumber" type="tel" required>
                                <p class="help-block">Enter the number here</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="message">Message</label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="4" id="message" name="message" required></textarea>
                                <ul id="sms-counter">
                                    <li>Encoding: <span class="encoding"></span></li>
                                    <li>Length: <span class="length"></span></li>
                                    <li>Messages: <span class="messages"></span></li>
                                    <li>Per Message: <span class="per_message"></span></li>
                                    <li>Remaining: <span class="remaining"></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit">Submit</label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
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

<script src="/js/intlTelInput.min.js"></script>
<script>
  $("#phoneNumber").intlTelInput({
    preferredCountries: ["MV"]
  });
</script>

@endsection

@section('css')
<link href="/css/intlTelInput.css" rel="stylesheet">

@endsection