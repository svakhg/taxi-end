@foreach($taxis as $key=>$taxi)
    <div class="col-md-2">
        <div class="box" style="
                <?php
                if($taxi->state == '0') {
                    echo 'background-color: #e74c3c';
                } elseif ($taxi->state == '1' && strtotime($taxi->anualFeeExpiry) > time() && strtotime($taxi->roadWorthinessExpiry) > time() && strtotime($taxi->insuranceExpiry) > time() ){
                    echo 'background-color: #1abc9c';
                } elseif (strtotime($taxi->anualFeeExpiry) < time() || strtotime($taxi->roadWorthinessExpiry) < time() || strtotime($taxi->insuranceExpiry) < time()) {
                    echo 'background-color: #9b59b6';
                }
                ?>
            ">
            <center>
            <h4>Taxi No: {{ $taxi->taxiNo }}</h4>
            <h3>{{ $taxi->callcode->callCode }}</h3>
            <h4>{{ $taxi->driver->driverName }}</h4>
            </center>
        </div>
    </div>
@endforeach

