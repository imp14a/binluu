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
    
    $('placesContainer').select('span').each(function(place){
        var lat = Number($(place).readAttribute('lat'));
        var lng = Number($(place).readAttribute('lng'));
        place = new google.maps.LatLng(lat,lng);
        placeMarker(place,false);
    });
    $('propertiesContainer').select('span').each(function(place){
        var lat = Number($(place).readAttribute('lat'));
        var lng = Number($(place).readAttribute('lng'));
        place = new google.maps.LatLng(lat,lng);
        placeMarker(place,true);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

function deleteOverlays() {
    if (markersArray.length >= 1) {
        markersArray[0].setMap(null);
        markersArray.length = 0;
    }
}

function placeMarker(location,adviser) {
    if(adviser){
        var urlIconColor ="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|3fa0cd";
        var pinImage = new google.maps.MarkerImage(urlIconColor,
            new google.maps.Size(21, 34),
            new google.maps.Point(0,0),
            new google.maps.Point(10, 34)
        );
        var marker = new google.maps.Marker({
	    position: location,
	    map: map,
            icon: pinImage,
	});
        
        var populationOptions = {
            strokeColor: '#3fa0cd',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#92d4cf',
            fillOpacity: 0.35,
            map: map,
            center: location,
            radius: 3000
        };
        new google.maps.Circle(populationOptions);
        
    }else{
        var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
    }
	markersArray.push(marker);
	markersArray[0].setMap(map);
}

</script>
<style>
    #map-canvas{
        width: 700px;
        height: 500px;
        display: inline-block;
    }
</style>
<div id="placesContainer" style="display:none;">
    <?php foreach ($ideal_properties as $place): ?>
        <span lat="<?php echo $place['IdealProperty']['latitude']; ?>" lng="<?php echo $place['IdealProperty']['longitude']; ?>"></span>
    <?php endforeach;?>
</div>
<div id="propertiesContainer" style="display:none;">
    <?php foreach ($adviser_properties as $property): ?>
        <span lat="<?php echo $property['AdviserProperty']['latitude']; ?>" lng="<?php echo $property['AdviserProperty']['longitude']; ?>"></span>
    <?php endforeach;?>
</div>
<div id="map-canvas"></div>
<script>
    
</script>