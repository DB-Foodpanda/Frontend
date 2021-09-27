<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
session_start();
require('../connect.php');

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$id_order = $_GET["id"];
$driver_username = $_GET["d"];
$shop_username = $_GET["shop"];
$shop_share = $_GET["s_s"];
$orders_total_price = $_GET["tt"];
$driver_status_rate =$_GET["d_r"];

$driver_earn_price =$_GET["de"];
$shop_earn_price =$_GET["se"];
$id_orders_status = 4;

$d_earn = $orders_total_price*$driver_status_rate;
$d_earn = $driver_earn_price+$d_earn;

$s_earn = $orders_total_price*$shop_share;
$s_earn = $shop_earn_price+$s_earn;


    $sql = "UPDATE `orders` SET `id_orders_status`= $id_orders_status ,orders_date_end_send = NOW() WHERE id_orders ='$id_order'";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);

    $sql1 = "UPDATE `driver` SET`driver_earn_price`=$d_earn WHERE driver_username ='$driver_username'";
    echo $sql1;
    $objQuery1 = mysqli_query($conn, $sql1);

    $sql2 = "UPDATE `shop` SET`shop_earn_price`=$s_earn WHERE shop_username ='$shop_username'";
    echo $sql2;
    $objQuery = mysqli_query($conn, $sql2);    

    if ($objQuery) {
	    header("Location: ./monitor_order.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>