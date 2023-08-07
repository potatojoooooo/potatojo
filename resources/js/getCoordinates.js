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

        // set coordinates into session
        sessionStorage.setItem("longitude", position.coords.longitude);
        sessionStorage.setItem("latitude", position.coords.latitude);

        console.log(sessionStorage.getItem("longitude"));
        console.log(sessionStorage.getItem("latitude"));
    }

    // Call the getLocation function to initiate geolocation
    getLocation();
});
