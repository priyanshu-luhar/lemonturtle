<?php
    require_once("config.php");
    require_once("nav.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
        <style>
#map {border: 10px solid blue; height: 500px;}            
        </style>
<script>
var map;

window.onload = function() {
    map = L.map('map').setView([35.34,-119.10], 3);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
}


</script>
    </head>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1>API URL</h1>
        <form action="map.php" method="post" enctype="multipart/form-data">
            <table style="width:100%;" align="center">
            <tr>
            <td align="left" style="width:90%;">
            <input style="width:97%; font-size:20pt; font-family:courier;" type="text" name="url" id="url">
            </td>
            <td align="right">
            <input style="font-size:20pt; font-family:courier;"; type="submit" value="Submit" name="request">
            </td>
            </tr>
            </table>
        </form>
<?php
    if (isset($_POST['request'])) {
        
        $url = $_POST['url'];
    } else {
        $url = "https://v2.jokeapi.dev/joke/Any?format=txt";

    }

    $myIP = $_SERVER[‘REMOTE_ADDR’];

    $cmd = "python3 getIP.py ".$_POST['url'];
    $command = escapeshellcmd($cmd);
    $output = shell_exec($command);
    echo $output;
    
    $cmd = "python3 getLatLng.py ".$_POST['url'];
    $command = escapeshellcmd($cmd);
    $output = shell_exec($command);

    $myLat = 35.35;
    $myLng = -119.11;

?>
    <script>
    var lat = <?php echo $myLat; ?>;
    var lng = <?php echo $myLng; ?>;

    L.marker([lat, lng]).addTo(map);

</script>
        <h1>MAP</h1>
        <div id="map"></div>

    </body>
</html>
