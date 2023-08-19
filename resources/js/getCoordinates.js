import axios from "axios";
window.axios = axios;

$(document).ready(function () {
    var x = $("#coordinates");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.html("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        x.html(
            "Latitude: " +
                position.coords.latitude +
                "<br>Longitude: " +
                position.coords.longitude
        );
        // getAddressFrom(
        //     position.coords.latitude,
        //     position.coords.longitude
        // );

        // set coordinates into session
        sessionStorage.setItem("longitude", position.coords.longitude);
        sessionStorage.setItem("latitude", position.coords.latitude);

        console.log(sessionStorage.getItem("longitude"));
        console.log(sessionStorage.getItem("latitude"));
    }

    function getAddressFrom(lat, long) {
        axios.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + long + "&key=")
    }

    // Call the getLocation function to initiate geolocation
    getLocation();
});
