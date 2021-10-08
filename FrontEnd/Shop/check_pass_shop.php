<?php
session_start();
require('../connect.php');
$shop_username = $_SESSION["shop_username"];
$sql = "
SELECT * FROM `shop` WHERE shop_username = '$shop_username' ;
";

$objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
$objResult = mysqli_fetch_array($objQuery);
if(isset($_REQUEST["shop_password"])){
    $shop_password = $_REQUEST["shop_password"];
    if($shop_password==$objResult["shop_password"]){
        header('location: Home.php?show=1');
    }
    else{
        header('location: Home.php');
    }
}
?>