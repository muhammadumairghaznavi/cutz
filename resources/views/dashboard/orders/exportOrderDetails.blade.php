<table class="table table-hover " id="data_table">
    <thead>
        <tr>

            <th>id</th>
            <th>order_id</th>
            <th>price</th>
            <th>qty</th>
            <th>type</th>
            <th>price_before_discount</th>
            <th>product_id</th>
            <th>product_idRms</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $index => $order)
            <tr>
                <td> {{ $order->id }}</td>
                <td> {{ $order->order_id }}</td>
                <td> {{ $order->price }}</td>
                <td> {{ $order->qty }}</td>
                <td> {{ $order->type }}</td>
                <td> {{ $order->price_before_discount }}</td>
                <td> {{ $order->product_id }}</td>
                <td> {{ $order->product->idRms }}</td>
                <td> {{ $order->created_at }}</td>
                <td> {{ $order->updated_at }}</td>


            </tr>
        @endforeach
    </tbody>
</table><!-- end of table -->
