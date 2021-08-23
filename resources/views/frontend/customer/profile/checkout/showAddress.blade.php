<div class="address-details">
    <div class="d-flex align-content-center justify-content-between">
        <div class="title d-flex align-items-center">
            <img src="assets/imgs/check-success.png" alt=""> <strong class="h6 d-block">Address Details:</strong>
        </div>
        <a href="{{route('customer.calculate_delivery_cost.remove')}}"><i class="fa fa-times"></i></a>
    </div>
    <hr style="background-color: #fff">
    <p>{{$address->firstName . $address->lastName}}</p>
    <p>{{$address->phone}}</p>
    <p>{{$address->customer_region}}</p>
    <p>{{$address->address}}</p>
    <p>{{$address->note}}</p>

  <p>{{$address->street}}</p>
  <p>{{$address->home_number}}</p>
  <p>{{$address->floor_number}}</p>
  <p>{{$address->postal_code}}</p>

</div>

