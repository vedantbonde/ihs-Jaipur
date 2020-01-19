<?php
require_once('config.php');

if (empty($_GET['city']) || empty($_GET['start']) || empty($_GET['end'])) {
    exit();
}

$city = $_GET['city'];

$start = datetime::createfromformat('Y-m-d\TH:i:s', $_GET['start']);
$start_date = $start -> format('Y-m-d');
$start_time = $start -> format('H:i');
$end = datetime::createfromformat('Y-m-d\TH:i:s', $_GET['end']);
$end_date = $end -> format('Y-m-d');
$end_time = $end -> format('H:i');

$query = "https://www.triposo.com/api/20190906/day_planner.json?location_id=".$city."&start_date=".$start_date."&arrival_time=".$start_time."&end_date=".$end_date."&departure_time=".$end_time."&account=".$TRIPOSO_ACCOUNT_ID."&token=".$TRIPOSO_API_TOKEN;
$response = json_decode(file_get_contents($query));
$response = $response -> results[0];

// var_dump($response);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Your Itinerary</title>

        <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }
        </style>
    </head>
    
    <body>
        <div style="float:left;width:50%;height:100%;">
            <div style="width:100%;height:100%;" id="mapContainer"></div>
        </div>
        
        <div id="itinerary">
            <div id="city_desc" style="background-image:url('<?php echo $response -> location -> images[0] -> sizes -> thumbnail -> url;?>')">
                <div id="city_name"><?php echo $response -> location -> name;?></div>
            </div>

            <div id="city_snippet">"<?php echo $response -> location -> snippet;?>""</div>

            <div id="tab-container"> 
                <?php
                $i = 0;
                for (; $i < count($response -> days) ; $i++) {
                    $day = $response -> days[$i];?>
                    <a href="#" onclick="switchTab('<?php echo $i;?>')">
                        <div class="tab-select">
                            Day <?php echo $i;?>
                        </div>
                    </a>
                <?php
                }
            ?>
            </div>
            
            <div id="t-contain">
            <?php
                $i = 0;
                for (; $i < count($response -> days) ; $i++) {
                    $day = $response -> days[$i];?>
                    <div class="day-tab" id="<?php echo $i;?>" style="display:none;">
                    <?php for ($j = 0; $j < count($day->itinerary_items); $j++) {?>
                        <div class="place">
                            <div class = "img">
                                <img class="img1" src="<?php echo $day -> itinerary_items[$j] -> poi -> images[0] -> sizes -> thumbnail -> url;?>">
                            </div>
                            <div class = "desc">
                                <div class="place-name"><?php echo $day -> itinerary_items[$j] -> poi -> name; ?></div>
                                <div class="place-snippet"><?php echo $day -> itinerary_items[$j] -> poi -> snippet; ?></div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                <?php
                }
                ?>
            </div>
            <script>
                function switchTab(id) {
                    for (var i = 0; i < <?php echo $i;?>; i++) {
                        document.getElementById(i).style.display = "none";
                    }

                    document.getElementById(id).style.display = "block";
                }
                document.getElementById("0").style.display = "block";
            </script>

        <script>
            var platform = new H.service.Platform({'apikey': 'tkirU53kCkropVPcraDrlFmrfFQC1chfO15m5FGmp8g'});
            var defaultLayers  = platform.createDefaultLayers();
            var map = new H.Map(
                document.getElementById('mapContainer'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 10,
                    center: { lng: 13.4, lat: 52.51 },
                    pixelRatio: window.devicePixelRatio || 1
                });
            
            window.addEventListener('resize', () => map.getViewPort().resize());
            var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            
            var ui = H.ui.UI.createDefault(map, defaultLayers);
            
            var group = new H.map.Group();

            var svgMarkup = '<svg width="24" height="24" ' +
            'xmlns="http://www.w3.org/2000/svg">' +
            '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
            'height="22" /><text x="12" y="18" font-size="12pt" ' +
            'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
            'fill="white">H</text></svg>';

            map.addObject(group);
            
            var icon = new H.map.Icon(svgMarkup);
            var marker = new H.map.Marker({lat: 52.53075, lng: 13.3851});
            group.addObject(marker);
            var marker1 = new H.map.Marker({lat:51.8788, lng: 13.465});
            group.addObject(marker1);
            
        </script>

    </body>
</html>