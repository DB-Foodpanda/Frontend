<?php

require('../connect.php');
session_start();
$shop_username = $_SESSION["shop_username"];

$sql = "
    DELETE FROM food
    WHERE food_id Like '".$_GET["itemId"]."';
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
