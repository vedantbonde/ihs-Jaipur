<?php
require_once('config.php');

// if (empty($_GET['lat']) || empty($_GET['lon'])) {
//     exit();
// }

// $lat = $_GET['lat'];
// $lon = $_GET['lon'];

if ($_GET['type'] == 'food') {

    if (empty($_GET['name'])) {
        exit();
    } else {
        $name = $_GET['name'];
    }

    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"user-key:".$ZOMATO_API_KEY
        )
    );
    $context = stream_context_create($opts);
    $response = json_decode(file_get_contents("https://developers.zomato.com/api/v2.1/locations?query=".$name."&lat=".$lat."&lon=".$lon, false, $context));
    
    $temp = $response -> location_suggestions[0];
    
    if (count($temp) > 0) {
        $response = file_get_contents("https://developers.zomato.com/api/v2.1/location_details?entity_id=".$temp -> entity_id."&entity_type=".$temp->entity_type, false, $context);
        var_dump($response);
    } else {
        echo "";
    }

} else if ($_GET['type'] == 'stay') {

    

} else if ($_GET['type'] == 'car') {
    $response = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=Seattle&destinations=San+Francisco&travelMode=TRANSIT&modes=BUS,RAIL,SUBWAY,TRAIN,TRAM&key=".$GOOGLE_MAPS_API);
    var_dump($response);
}



