<?php
    require_once("config.php");
    require_once("nav.php");


?>

<html>
    <head>
        <title>CMPS 4420 Lab 4</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
        <style>
#map {border: 10px solid blue; height: 800px; width: 750px;}            
        </style>
<script>
var map;

window.onload = function() {
    map = L.map('map').setView([35.34,-119.10], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([35.34,-119.10]).addTo(map);
    var popup = L.popup()
    .setLatLng([35.35,-119.11])
    .setContent("I am a standalone popup.")
    .openOn(map);
}


</script>
    </head>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        
        <h1>MAP</h1>
        
        <div id="map"></div>

    </body>
</html>
