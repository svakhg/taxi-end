@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Configure</a></li>
    <li><a href="{{ url('configure/taxi') }}">Taxi</a></li>
    <li class="active">Taxi View</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Taxi View</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
              <table class="table table-striped">
                  <thead>
                        <th>callcode_id</th>
                        <th>taxiNo</th>
                        <th>taxiChasisNo</th>
                        <th>taxiEngineNo</th>
                        <th>taxiBrand</th>
                        <th>taxiModel</th>
                        <th>taxiColor</th>
                        <th>taxiOwnerName</th>
                        <th>taxiOwnerMobile</th>
                        <th>taxiOwnerEmail</th>
                        <th>taxiOwnerAddress</th>
                        <th>registeredDate</th>
                        <th>anualFeeExpiry</th>
                        <th>roadWorthinessExpiry</th>
                        <th>insuranceExpiry</th>
                        <th>rate</th>
                        <th>taken</th>
                        <th>center_name</th>
                  </thead>
                  <tbody>
                        <td>{{ $taxi->callcode_id }}</td>
                        <td>{{ $taxi->taxiNo }}</td>
                        <td>{{ $taxi->taxiChasisNo }}</td>
                        <td>{{ $taxi->taxiEngineNo }}</td>
                        <td>{{ $taxi->taxiBrand }}</td>
                        <td>{{ $taxi->taxiModel }}</td>
                        <td>{{ $taxi->taxiColor }}</td>
                        <td>{{ $taxi->taxiOwnerName }}</td>
                        <td>{{ $taxi->taxiOwnerMobile }}</td>
                        <td>{{ $taxi->taxiOwnerEmail }}</td>
                        <td>{{ $taxi->taxiOwnerAddress }}</td>
                        <td>{{ $taxi->registeredDate }}</td>
                        <td>{{ $taxi->anualFeeExpiry }}</td>
                        <td>{{ $taxi->roadWorthinessExpiry }}</td>
                        <td>{{ $taxi->insuranceExpiry }}</td>
                        <td>{{ $taxi->rate }}</td>
                        <td>{{ $taxi->taken }}</td>
                        <td>{{ $taxi->center_name }}</td>
                  </tbody>
              </table>
            </div> 
            <div class="col-md-12">
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$taxi->taxi_front_url_o }}" alt="">
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$taxi->taxi_back_url_o }}" alt="">
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$taxi->taxi_front_url_t }}" alt="">
                <hr>
                <img src="{{ 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$taxi->taxi_back_url_t }}" alt="">
                <hr>
            </div> 
        </div>
    </div>        
</div>
@endsection