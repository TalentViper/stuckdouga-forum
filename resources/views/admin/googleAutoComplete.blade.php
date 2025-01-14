<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Map</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
            height: 700px;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-2">
        <input type="text" class="d-block" id="searchTextField" size="50" value="<?php echo $data; ?>">
        <div id="map" class="mt-3"></div>
    </div>
    <script type="text/javascript">
        function initMap() {
            const address = "{{ $data }}";
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const latitude = results[0].geometry.location.lat();
                    const longitude = results[0].geometry.location.lng();

                    const myLatLng = {
                        lat: latitude,
                        lng: longitude
                    };

                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: myLatLng
                    });
                    new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: address,
                    });

                    const input = document.getElementById("searchTextField");
                    const autocomplete = new google.maps.places.Autocomplete(input, {
                        componentRestrictions: {
                            country: 'GB'
                        }
                    });
                    autocomplete.bindTo('bounds', map);

                    autocomplete.addListener("place_changed", () => {
                        const place = autocomplete.getPlace();
                        if (!place.geometry) {
                            console.log("No details available for input: '" + place.name + "'");
                            return;
                        }

                        // Use the selected place's location for further processing
                        const location = place.geometry.location;
                        const selectedLatLng = {
                            lat: location.lat(),
                            lng: location.lng()
                        };

                        // Do something with the selected location
                        console.log("Selected Location:", selectedLatLng);

                        // Update the map center and marker position with the selected location
                        map.setCenter(selectedLatLng);
                        new google.maps.Marker({
                            position: selectedLatLng,
                            map: map,
                            title: place.name,
                        });
                    });
                } else {
                    console.log('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
        window.initMap = initMap;
    </script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initMap">
    </script>
</body>

</html>
