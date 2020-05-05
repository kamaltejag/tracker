<?php
    
    // $server = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "tracker";

    $server = "localhost";
    $username = "packetpz_kamal";
    $password = "HELERcar";
    $dbname = "packetpz_kamal";

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }

?>

