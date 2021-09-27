<?php
session_start();
require('../connect.php');
$shop_username = $_SESSION["S_username"];
$sql = "
SELECT * FROM `shop` WHERE S_username = '$shop_username' ;
";

$objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
$objResult = mysqli_fetch_array($objQuery);
if(isset($_REQUEST["S_password"])){
    $shop_password = $_REQUEST["S_password"];
    if($shop_password==$objResult["S_password"]){
        header('location: Home.php?show=1');
    }
    else{
        header('location: Home.php');
    }
}
?>