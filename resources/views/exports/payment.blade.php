<table>
    <thead>
        <tr>
            <th>Payment Id</th>
            <th>Call Code</th>
            <th>Taxi Number</th>
            <th>Month</th>
            <th>Year</th>
            <th>Total Paid</th>
            <th>Paid</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->taxi->callcode->callCode }}</td>
                <td>{{ $payment->taxi->taxiNo }}</td>
                <td>{{ Carbon\Carbon::createFromFormat('m', $payment->month)->format('F') }}</td>
                <td>{{ $payment->year }}</td>
                <td>{{ $payment->totalAmount }}</td>
                <td>{{ $payment->paymentStatus }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>