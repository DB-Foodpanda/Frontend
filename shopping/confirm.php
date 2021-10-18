<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
session_start();
require('../connect.php');

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
print_r($_GET);
$order_id = $_GET["id"];
$driver_username = $_GET["d"];
$shop_username = $_GET["shop"];
$order_price = $_GET["tt"];

$driver_earn_price =$_GET["de"];
$shop_earn_price =$_GET["se"];
$order_status = 4;

$d_earn = ($order_price *20/100) + $driver_earn_price;

$s_earn = ($order_price *80/100) + $shop_earn_price;



    $sql = "UPDATE `order` SET `order_status`= $order_status ,order_dateendsend = NOW() WHERE order_id ='$order_id'";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);

    $sql1 = "UPDATE `driver` SET`driver_earnprice`= $d_earn WHERE driver_username ='$driver_username'";
    echo $sql1;
    $objQuery1 = mysqli_query($conn, $sql1);

    $sql2 = "UPDATE `shop` SET`shop_earnprice`= $s_earn WHERE shop_username ='$shop_username'";
    echo $sql2;
    $objQuery = mysqli_query($conn, $sql2);    

    if ($objQuery) {
	    header("Location: ./monitor_order.php?order_status=4"); 
        exit;
    }else {
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>