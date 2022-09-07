<?php

// site info 
$root = "/ots";
$site_name = "Star-Education";

// database connection 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "online_class";

$conn = new mysqli($hostname, $username, $password, $database) ;

if ($conn->connect_error) {
    die("Connection Failed");
}
