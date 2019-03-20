var Maps = {
    lat: 64.9421148,
    long: -151.1459782,

    // Initialise la carte de l'API googleMap
    initMap: function () {
        var map = new google.maps.Map(document.getElementById("iframe"), {
            center: {
                lat: this.lat,
                lng: this.long
            },
            zoom: 7
        });
    }
};

function initApp() {
    var carte = Object.create(Maps);
    carte.initMap();
};
