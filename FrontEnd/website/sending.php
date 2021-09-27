<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
session_start();
require('../connect.php');
$driver_username = $_SESSION["driver_username"]; 
//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$id_order = $_GET["id"];
$id_orders_status = 3;


    $sql = "UPDATE `orders` SET `id_orders_status`= $id_orders_status WHERE id_orders ='$id_order'";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: ./driver.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>