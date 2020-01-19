<?php
require_once('config.php');

$city = $_GET['search'];

$response = file_get_contents("https://geocoder.ls.hereapi.com/6.2/geocode.json?searchtext=" . $city . "&apiKey=".$HERE_MAPS_API_KEY);
$pos = json_decode($response) -> Response -> View[0] -> Result[0] -> Location -> NavigationPosition[0];
$at = $pos -> Latitude . "," . $pos -> Longitude . ";r=1000";

if ($_GET['type'] == 'attractions') {

    
    var_dump(file_get_contents("https://places.sit.ls.hereapi.com/places/v1/discover/explore?cat=accommodation&at=" . $temp . "&apiKey=".$HERE_MAPS_API_KEY));

} else if ($_GET['type'] == 'food') {



} else if ($_GET['type'] == 'stay') {



}