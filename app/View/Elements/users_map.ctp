<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var geocoder;
var map;
var markersArray = [];

function initialize() {
    geocoder = new google.maps.Geocoder();
    mapZoom = 5; 
    mapCenter = new google.maps.LatLng(22.913,-101.929);
    var mapOptions = {
        zoom: mapZoom,
        center: mapCenter,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    google.maps.event.addListener(map, 'dblclick', function(event) {
        placeMarker(event.latLng);
    });
}

function deleteOverlays() {
    if (markersArray.length >= 1) {
        markersArray[0].setMap(null);
        markersArray.length = 0;
    }
}

function placeMarker(location) {
	deleteOverlays();
	var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
	markersArray.push(marker);
	markersArray[0].setMap(map);
}

</script>
<style>
    #map-canvas{
        width: 500px;
        height: 500px;
    }
</style>
<div id="map-canvas"></div>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);
</script>