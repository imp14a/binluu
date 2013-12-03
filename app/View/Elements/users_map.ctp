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

	var mapZoom = 5;
	if($("IdealPropertyLatitude").getValue()!=""){
    	mapCenter = new google.maps.LatLng(
    		Number($("IdealPropertyLatitude").getValue()),
    		Number($("IdealPropertyLongitude").getValue())
    	);
    	mapZoom = 8; 
    }else{
    	mapCenter = new google.maps.LatLng(22.913,-101.929);
    }

	var mapOptions = {
        zoom: mapZoom,
        center: mapCenter,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    if($("IdealPropertyLatitude").getValue()!=""){
    	placeMarker(mapCenter);
    }

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
	$('IdealPropertyLatitude').setValue(location.lat());
	$('IdealPropertyLongitude').setValue(location.lng());
	deleteOverlays();
	var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
	markersArray.push(marker);
	markersArray[0].setMap(map);
	
}

</script>

<div id="map-canvas"></div>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);
</script>