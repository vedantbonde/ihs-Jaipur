<?php
require_once('config.php');


if ($_GET['type'] == 'car') {

    var_dump(file_get_contents("https://route.ls.hereapi.com/routing/7.2/calculateroute.json?apiKey=".$HERE_MAPS_API_KEY."&waypoint0=geo!"."52.5,13.4&waypoint1=geo!"."52.5,13.45&mode=fastest;car"));

} else if ($_GET['type'] == 'public') {

    

} else if ($_GET['type'] == 'stay') {


}



