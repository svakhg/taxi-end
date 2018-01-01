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
                        <th>taxiOwnerName</th>
                        <th>taxiOwnerMobile</th>
                        <th>taxiOwnerEmail</th>
                        <th>taxiOwnerAddress</th>
                        <th>registeredDate</th>
                        <th>anualFeeExpiry</th>
                        <th>roadWorthinessExpiry</th>
                        <th>insuranceExpiry</th>
                  </thead>
                  <tbody>
                      @foreach ($taxis as $taxi)
                          <tr>
                                <td>{{ $taxi->callcode->callCode }}</td>
                                <td>{{ $taxi->taxiNo }}</td>
                                <td>{{ $taxi->taxiOwnerName }}</td>
                                <td>{{ $taxi->taxiOwnerMobile }}</td>
                                <td>{{ $taxi->taxiOwnerEmail }}</td>
                                <td>{{ $taxi->taxiOwnerAddress }}</td>
                                <td>{{ $taxi->registeredDate }}</td>
                                <td>{{ $taxi->anualFeeExpiry }}</td>
                                <td>{{ $taxi->roadWorthinessExpiry }}</td>
                                <td>{{ $taxi->insuranceExpiry }}</td>
                          </tr>    
                      @endforeach
                        
                  </tbody>
              </table>
            </div> 
          
        </div>
    </div>        
</div>
@endsection