<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <title>Get Current Location and Display on Google Map</title>
    <style>
      #map {
        height: 500px;
        width: 100%;
      }
    </style>
  </head>
  <body onload="getLocation()">
    <div id="map"></div>
    <script>
      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        }
      }
      function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        alert(
          "Latitude: " +
            latitude +
            "\nLongitude: " +
            longitude
        );

        // Initialize the map
        var myLatLng = {
          lat: latitude,
          lng: longitude,
        };
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: myLatLng,
        });

        // Add a marker
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
        });
      }
    </script>
    <script
      async
      defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGr_MqBTdKWTW_MDFnGUUxjFKk_HyrTb0&callback=initMap"
      type="text/javascript"
    ></script>
  </body>
</html>
