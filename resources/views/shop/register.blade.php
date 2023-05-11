@extends('master.adminLayout')
@section('contentNav')

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Register Shop</h1>
            </div>
    <form action="{{ route('shop.register.submit') }}" method="POST">
      @csrf
      <div>
          <label for="name">Shop Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required>
      </div>
      <div style="display: none;">

          <label for="location">Shop latitude</label>

          <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}">
          </div>

          <div style="display: none;">
          <label for="location">Shop longitude</label>

           <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" >
           </div>
      </div>
      <div id="map" style="height: 400px"></div>

      <button type="submit">Register</button>
    </form>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmVLQZ8lfZuiG-zKbLpAPIVXY2Lj6vX_o&libraries=places&callback=initMap" ></script>

    <script>
     function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 31.53946647182732, lng: -7.811589278443034},
          zoom: 8
      });

      var marker = new google.maps.Marker({
          position: {lat: 31.53946647182732, lng: -7.811589278443034},
          map: map,
          draggable: true
      });

      google.maps.event.addListener(marker, 'dragend', function(event) {
          document.getElementById('latitude').value = event.latLng.lat();
          document.getElementById('longitude').value = event.latLng.lng();
      });

      google.maps.event.addListener(map, 'click', function(event) {
          marker.setPosition(event.latLng);
          document.getElementById('latitude').value = event.latLng.lat();
          document.getElementById('longitude').value = event.latLng.lng();
      });
  }

    </script>
    </div>
</div>
  </body>s
  <style>
    form {
      display: flex;
      flex-direction: column;
      max-width: 400px;
      margin: auto;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    label {
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type=text] {
      padding: 8px;
      margin-bottom: 20px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    #map {
    height: 400px;
    width: 100%;
  }
  </style>

@endsection

