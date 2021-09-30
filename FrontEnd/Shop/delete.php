<?php

require('../../Grab_present/connect.php');
session_start();
$shop_username = $_SESSION["S_username"];

$sql = "
    DELETE FROM food
    WHERE Food_id Like '".$_GET["itemId"]."';
    ";
//echo $sql;
$objQuery = mysqli_query($conn, $sql);
if ($objQuery) {
    header("location:Home.php?state=1");
} else {
    echo "Error : Delete";
}

mysqli_close($conn); // ปิดฐานข้อมูล

?>
