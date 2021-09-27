<?php
session_start();
require('../connect.php');
$driver_username = $_SESSION["driver_username"];
$sql = "
SELECT * FROM `driver` WHERE driver_username = '$driver_username' ;
";

$objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
$objResult = mysqli_fetch_array($objQuery);
if(isset($_REQUEST["driver_password"])){
    $driver_password = $_REQUEST["driver_password"];
    if($driver_password==$objResult["driver_password"]){
        header('location: driver.php?show=1');
    }
    else{
        header('location: driver.php');
    }
}
?>