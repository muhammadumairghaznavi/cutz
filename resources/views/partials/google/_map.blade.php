<!-- en get states and regoins and streests  -->
<script>
  // Initialize the map.
  @php
    $lat = !empty(old('lat')) ? old('lat') : 30.05806302883548;
    $lng = !empty(old('lng')) ? old('lng') : 31.20761839389786;
  @endphp

  function GetAddress() {
    var lat = parseFloat(document.getElementById("lat").value);
    var lng = parseFloat(document.getElementById("lng").value);
    var latlng = new google.maps.LatLng(lat, lng);
    var geocoder = geocoder = new google.maps.Geocoder();
    geocoder.geocode({
      'latLng': latlng
    }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
          $('#location').val(results[1].formatted_address);
        }
      }
    });
  }

  function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {
        lat: {!!$lat!!},
        lng: {!!$lng!!}
      }
    });

    var markerOne = new google.maps.Marker({
      position: {
        lat: {!!$lat!!},
        lng: {!!$lng!!}
      },
      map: map,
      draggable: true
    });

    var searchBox = new google.maps.places.SearchBox(document.getElementById('location'));

    google.maps.event.addListener(searchBox, 'places_changed', function () {
      var places = searchBox.getPlaces();
      var boundsOne = new google.maps.LatLngBounds();
      var i, place;

      for (i = 0; place = places[i]; i++) {
        boundsOne.extend(place.geometry.location);
        markerOne.setPosition(place.geometry.location);
      }
      map.fitBounds(boundsOne);
      map.setZoom(15);
    });

    google.maps.event.addListener(markerOne, 'position_changed', function () {

      var lat = markerOne.getPosition().lat();
      var lng = markerOne.getPosition().lng();
      $('#lat').val(lat);
      $('#lng').val(lng);
      GetAddress();

    });

  }

</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfZ9uoqq6GuMOzgn-P-NA4gImzSpLXkoc&callback&callback=initMap&libraries=places"
    async defer>
</script>
<script type="text/javascript" src="{!! asset('dashboard/js/locationpicker.jquery.js') !!}"></script>
<div class="form-group">
    <label>@lang('site.address')</label>
    <input type="text" name='address' value="{{old('address')}}" class="form-control" id="location">
</div>
<div class="form-group">
    <div id="map" style="height:300px !important"></div>
</div>
<div class="form-group">
    <label>Lat</label>
    <input type="text"  readonly class="form-control" id="lat" name="lat" value="{!! $lat !!}">
</div>
<div class="form-group">
    <label>lng</label>
    <input type="text" readonly class="form-control" id="lng" name="lng" value="{!! $lng !!}">
</div>
