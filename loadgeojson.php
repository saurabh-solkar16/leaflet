<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Starter map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <!-- MAP SCRIPT -->
    <script>
    // Add AJAX request for data
        var counties = $.ajax({
          url:"http://localhost:8080/leaflet/try/mysql-geojson.php",
          dataType: "json",
          success: console.log("County data successfully loaded."),
          error: function (xhr) {
            alert(xhr)
          }
        })

        $.when(counties).done(function() {
            var map = L.map('map')
                .setView([74.86083, 19.72534], 7);
            var basemap = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);
            L.geoJSON(counties.responseJSON,{}).addTo(map);

        });

    </script>
</body>

</html>