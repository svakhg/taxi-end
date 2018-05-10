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
                @else
                    <td>No Driver</td>
                    <td>No Driver</td>
                @endif
            
            @else
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Taxi</td>
                <td>No Driver (No Taxi)</td>
                <td>No Driver (No Taxi)</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>