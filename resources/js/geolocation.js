$(document).ready(function() {
    // complete location entered
    var autocomplete;
    var to = 'location';
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)), {
        types: ['geocode'],
    });

    // get longitude and latitude
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var near_place = autocomplete.getPlace();
        jQuery("#lat").val(near_place.geometry.location.lat());
        jQuery("#long").val(near_place.geometry.location.lng());

        $.getJSON("https://api.ipify.org/?format=json", function(data) {
            let ip = data.ip;
            jQuery("#ip").val(ip);
            getCity(ip);
        });
    });
});

// get the city current of current user
function getCity(ip) {

    var req = new XMLHttpRequest();
    req.open("GET", "http://ip-api.com/json/" + ip, true);
    req.send();
    req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
            var obj = JSON.parse(req.responseText);
            console.log(obj);
            jQuery("#city").val(obj.city);
            calculateDistance();
        }
    }
}

// calculate the distance between current city and location chosen
function calculateDistance() {
    var from = jQuery("#city").val();
    var to = jQuery("#location").val();

    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [from],
        destinations: [to],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.metric,
        avoidHighways: false,
        avoidTolls: false,
    }, callback);
}

// display result or error
function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        console.log("Something wrong");
    } else {
        if (response.rows[0].elements[0].status == "ZERO_RESULTS") {
            console.log("No roads");
        } else {
            var distance = response.rows[0].elements[0].distance;
            var duration = response.rows[0].elements[0].duration;
            var dkm = distance.value/1000;
            console.log(distance, duration, dkm);
            jQuery("#dtime").val(duration.text);
            jQuery("#dkm").val(distance.text);
        }

    }
}