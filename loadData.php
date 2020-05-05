<?php

include 'includes/includes.php';

$result = loadData($conn);

foreach($result as $r){
  $latitude = $r['latitude'];
  $longitude = $r['longitude'];
}

$location[0] = $latitude;
$location[1] = $longitude;


echo json_encode($location);


?>