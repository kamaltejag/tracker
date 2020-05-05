<?php

function change($conn, $latitude, $longitude){
    $sql = "UPDATE tracker_data SET latitude = $latitude, longitude = $longitude where id = 1"; 
    $query = mysqli_query($conn, $sql);
}

function loadData($conn){
    $sql = "SELECT * FROM tracker_data";
    $query = mysqli_query($conn, $sql);
    return $query;
  }
  

?>