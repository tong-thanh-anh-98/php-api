<?php
$host = "localhost";
$username = "root";
$password = "";
$data_name = "db_api";

$connect = mysqli_connect($host, $username, $password, $data_name);

if (!$connect) {
    # code...
    die("Connection Failed: " . mysqli_connect_error());
}