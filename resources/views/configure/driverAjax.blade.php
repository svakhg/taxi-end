<?php
    if($driver->taxi->state == '0' || $driver->taxi->state == null) {
        $color = '#e74c3c';
    } elseif ($driver->taxi->state == '1' && strtotime($driver->taxi->anualFeeExpiry) > time() && strtotime($driver->taxi->roadWorthinessExpiry) > time() && strtotime($driver->taxi->insuranceExpiry) > time() ){
        $color = '#1abc9c';
    } elseif (strtotime($driver->taxi->anualFeeExpiry) < time() || strtotime($driver->taxi->roadWorthinessExpiry) < time() || strtotime($driver->taxi->insuranceExpiry) < time()) {
        $color = '#9b59b6';
    }
?>
<div class="modal-content" style="border: 5px solid <?php echo $color ?>; border-radius: 10px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="margin-left:15px;">Driver View</h4>
    </div>
    <div class="modal-body">
        <div class="col-md-2">
            <img src="http://via.placeholder.com/180x250">
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-left:10px">
                <h4 style="display: inline"><strong>Call Code: </strong>{{ $driver->taxi->callcode->callCode }}</h4>
                <h4 style="display: inline; padding-left:100px"><strong>Taxi No: </strong>{{ $driver->taxi->taxiNo }}</h4>
                <h4 style="display: inline; padding-left:100px"><strong>Driver Name: </strong>{{ $driver->driverName }}</h4>
                <hr style="clear:both;"/>
            </div>
            <div class="row" style="margin-top:10px">
            <?php
                if ($color == "#e74c3c"){
                    echo '<div class="alert alert-danger">';
                    echo '<strong>Alert!</strong> There are some unpaid payments';
                    echo '</div>';
                } 
                elseif ($color == "#9b59b6"){
                    echo '<div class="alert alert-warning">';
                    echo '<strong>Alert!</strong> There are some expired items';
                    echo '</div>';
                }
                elseif ($color == "#1abc9c"){
                    echo '<div class="alert alert-success">';
                    echo '<strong>Info</strong> The Payment for this month is paid and nothing is expired';
                    echo '</div>';
                }
            ?>
            </div>                 
            <div class="row" style="margin-left:10px">
                <div style="display: inline;float: left; font-size:23px; width:50%; height:100%">
                    <h4 style="text-decoration: underline;">Expiry Dates</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li>Annual Fee Expiry: <?php echo date('d/m/Y', strtotime($driver->taxi->anualFeeExpiry)) ?></li>
                        <li>Road Worthiness Expiry: <?php echo date('d/m/Y', strtotime($driver->taxi->roadWorthinessExpiry)) ?></li>
                        <li>Insurance Expiry: <?php echo date('d/m/Y', strtotime($driver->taxi->insuranceExpiry)) ?></li>
                    </ul>    
                </div>
                <div style="display: inline;float: left; font-size:23px; width:50%; height:100%">
                    <h4 style="text-decoration: underline;">Driver Details</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li>Driver Mobile: {{ $driver->driverMobile }}</li>
                        <li>Driver Licence No: {{ $driver->driverLicenceNo }}</li>
                        <li>Driver Id Card No: {{ $driver->driverIdNo }}</li>
                    </ul>
                </div> 
            </div> 
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>