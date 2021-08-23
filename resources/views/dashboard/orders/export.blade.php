<table class="table table-hover " id="data_table">
    <thead>
        <tr>
            <th>id</th>

            <th>device_type</th>
            <th>customer_id</th>


            <th>total</th>
            <th>status</th>
            <th>shipping_number</th>
            <th>customer_name</th>
            <th>customer_address</th>
            <th>customer_phone</th>
            <th>customer_email</th>
            <th>customer_city</th>
            <th>customer_country</th>
            <th>customer_region</th>
            <th>customer_street</th>
            <th>customer_home_number</th>
            <th>customer_floor_number</th>
            <th>customer_appartment_number</th>
            <th>customer_postal_code</th>
            <th>customer_comments_extra</th>
            <th>langtude</th>
            <th>lattude</th>
            <th>payment_method</th>
            <th>payment_status</th>
            <th>taxes</th>
            <th>delivery_fees</th>
            <th>promocode</th>
            <th>created_at</th>
            <th>updated_at</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $index => $order)
            <tr>
                <td> {{ $order->id }}</td>

                <td> {{ $order->device_type }}</td>
                <td> {{ $order->customer_id }}</td>


                <td> {{ $order->total }}</td>
                <td> {{ $order->status }}</td>
                <td> {{ $order->shipping_number }}</td>
                <td> {{ $order->customer_name }}</td>
                <td> {{ $order->customer_address }}</td>
                <td> {{ $order->customer_phone }}</td>
                <td> {{ $order->customer_email }}</td>
                <td> {{ $order->customer_city }}</td>
                <td> {{ $order->customer_country }}</td>
                <td> {{ $order->customer_region }}</td>
                <td> {{ $order->customer_street }}</td>
                <td> {{ $order->customer_home_number }}</td>
                <td> {{ $order->customer_floor_number }}</td>
                <td> {{ $order->customer_appartment_number }}</td>
                <td> {{ $order->customer_postal_code }}</td>
                <td> {{ $order->customer_comments_extra }}</td>
                <td> {{ $order->langtude }}</td>
                <td> {{ $order->lattude }}</td>
                <td> {{ $order->payment_method }}</td>
                <td> {{ $order->payment_status }}</td>
                <td> {{ $order->taxes }}</td>
                <td> {{ $order->delivery_fees }}</td>
                <td> {{ $order->promocode }}</td>
                <td> {{ $order->created_at }}</td>
                <td> {{ $order->updated_at }}</td>
            </tr>


        @endforeach
    </tbody>
</table><!-- end of table -->
