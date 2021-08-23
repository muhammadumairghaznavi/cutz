<table class="table table-hover" id="data_table">
    <thead>
        <tr>
            <th>
                id
            </th>
            <th>
                full_name
            </th>
            <th>
                phone
            </th>
            <th>
                email
            </th>
            <th>
                social_id
            </th>
            <th>
                deviceType
            </th>
            <th>
                status
            </th>
            <th>
                gender
            </th>
            <th>
                provider
            </th>
            <th>
                provider_id
            </th>
            <th>
                lat
            </th>
            <th>
                lng
            </th>
            <th>
                customer_address
            </th>
            <th>
                customer_region
            </th>
            <th>
                customer_street
            </th>
            <th>
                customer_home_number
            </th>
            <th>
                customer_floor_number
            </th>
            <th>
                customer_appartment_number
            </th>
            <th>
                customer_postal_code
            </th>
            <th>
                customer_comments_extra
            </th>
            <th>
                created_at
            </th>
            <th>
                updated_at
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $index=>$customer)
        <tr>
            <td>
                {{ $customer->id}}
            </td>
            <td>
                {{ $customer->full_name}}
            </td>
            <td>
                {{ $customer->phone}}
            </td>
            <td>
                {{ $customer->email}}
            </td>
            <td>
                {{ $customer->social_id}}
            </td>
            <td>
                {{ $customer->deviceType}}
            </td>
            <td>
                {{ $customer->status}}
            </td>
            <td>
                {{ $customer->gender}}
            </td>
            <td>
                {{ $customer->provider}}
            </td>
            <td>
                {{ $customer->provider_id}}
            </td>
            <td>
                {{ $customer->lat}}
            </td>
            <td>
                {{ $customer->lng}}
            </td>
            <td>
                {{ $customer->customer_address}}
            </td>
            <td>
                {{ $customer->customer_region}}
            </td>
            <td>
                {{ $customer->customer_street}}
            </td>
            <td>
                {{ $customer->customer_home_number}}
            </td>
            <td>
                {{ $customer->customer_floor_number}}
            </td>
            <td>
                {{ $customer->customer_appartment_number}}
            </td>
            <td>
                {{ $customer->customer_postal_code}}
            </td>
            <td>
                {{ $customer->customer_comments_extra}}
            </td>
            <td>
                {{ $customer->created_at}}
            </td>
            <td>
                {{ $customer->updated_at}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table><!-- end of table -->
