<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
session_start();
require('../connect.php');
$driver_username = $_SESSION["driver_username"]; 
$order_id = $_GET["id"];

    $sql = "UPDATE `order` SET `order_status`= 5 WHERE order_id = $order_id";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: ./driver.php?state=5"); 
        exit;
    }else {
        echo "<br>";
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>