<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'foodpanda';

$conn = mysqli_connect($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");

if (!$conn){
    die("Database Connection Failed" . mysqli_error($conn));
}
$select_db = mysqli_select_db($conn, $dbname);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($conn));
}

?>