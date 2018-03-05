@extends('layouts.app')

@section('content')
    
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Other Payments</h3>
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
                
                <form action="{{ url('other-payments/redirect') }}" method="POST" role="form">
                    {{ csrf_field() }}
                
                    <h5>Select Type:</h5>
                    <div class="radio">
                        <label>
                            <input type="radio" name="type" value="invoice">
                            Invoice
                        </label>
                        <label>
                            <input type="radio" name="type" value="quotation">
                            Quotation
                        </label>
                        <label>
                            <input type="radio" name="type" value="receipt">
                            Reciept
                        </label>
                    </div>
                    
                    <hr>

                    <h5>Select Company:</h5>
                    <div class="radio">
                        <label>
                            <input type="radio" name="company" value="taviyani">
                            Taviyani PVT
                        </label>
                        <label>
                            <input type="radio" name="company" value="city">
                            City Cab
                        </label>
                        <label>
                            <input type="radio" name="company" value="jr">
                            JR Taxi
                        </label>
                        <label>
                            <input type="radio" name="company" value="tds">
                            Taviyani Driving School
                        </label>
                    </div>
                    
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div> 
        </div>
        
    </div>        
</div>

@endsection