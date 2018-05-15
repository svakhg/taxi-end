<?php
    function shownInDisplay($taxi) {
        // Check if taxi no. is not "-"
        if ($taxi->taxiNo == "-") {
            return false;
        } 
        
        // Check if taxi is not deactivated
        if ($taxi->active == '0') {
            return false;
        }
        
        // Check if driver is added and driver name is not "-"
        if (!is_null($taxi->driver)) {
            if ($taxi->driver->driverName == '-'){
                return false;
            }
        }

        // Check if driver is added
        if (is_null($taxi->driver)) {
            return false;
        }
    }

    function comment($taxi) {
        // Check if taxi no. is not "-"
        if ($taxi->taxiNo == "-") {
            return 'Taxi No. is -';
        } 
        
        // Check if taxi is not deactivated
        if ($taxi->active == '0') {
            return 'Taxi is deactivated';
        }
        
        // Check if driver is added and driver name is not "-"
        if (!is_null($taxi->driver)) {
            if ($taxi->driver->driverName == '-'){
                return 'Driver name is -';
            }
        }

        // Check if driver is added
        if (is_null($taxi->driver)) {
            return 'No Driver added to the taxi';
        }

        return 'No errors found';
    }
?>
<table>
    <thead>
    <tr>
        <th>Call Code ID</th>
        <th>Call Code</th>
        <th>Call Code Taken</th>

        <th>Taxi Center Name</th>

        <th>Taxi ID</th>
        <th>Taxi No</th>
        <th>Taxi Taken</th>
        <th>Taxi Acitve Status</th>
        
        <th>Driver ID</th>
        <th>Driver Name</th>

        <th>Show in Display</th>
        <th>Payment Generated</th>

        <th>Comment</th>
    </tr>
    </thead>
    <tbody>
    @foreach($callcodes as $callcode)
        <tr>
            <td>{{ $callcode->id }}</td>
            <td>{{ $callcode->callCode }}</td>
            <td>{{ $callcode->taken }}</td>

            <td>{{ $callcode->taxicenter->name }}</td>
            
            @if (!is_null($callcode->taxi))
                <td>{{ $callcode->taxi->id }}</td>
                <td>{{ $callcode->taxi->taxiNo }}</td>
                <td>{{ $callcode->taxi->taken }}</td>
                <td>{{ $callcode->taxi->active }}</td>
            
                @if (!is_null($callcode->taxi->driver))
                    <td>{{ $callcode->taxi->driver->id }}</td>
                    <td>{{ $callcode->taxi->driver->driverName }}</td>
                    @if (shownInDisplay($callcode->taxi) === false)
                        <td>No</td>
                        <td>No</td>
                    @else
                        <td>Yes</td>
                        <td>Yes</td>
                    @endif
                    <td>{{ comment($callcode->taxi) }}</td>
                @else
                    <td>No Driver</td>
                    <td>No Driver</td>                
                    @if (shownInDisplay($callcode->taxi) === false)
                        <td>No</td>
                        <td>No</td>
                    @else
                        <td>Yes</td>
                        <td>Yes</td>
                    @endif
                    <td>{{ comment($callcode->taxi) }}</td>
                @endif
            
            @else
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Driver (No Taxi)</td>
                <td>No Driver (No Taxi)</td>
                <td>No</td>
                <td>No</td>
                <td>No taxi or driver added to this callcode</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>