<?php
session_start();
require('../connect.php');
$driver_id = $_SESSION["driver_id"];
 
//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$order_id = $_GET["id"];

    $sql = "UPDATE `order` SET `driver_id`='$driver_id',`order_status`= 2 WHERE order_id = $order_id";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);
    
    if ($objQuery) {
	    header("Location: ./driver.php?state=2"); 
        exit;
    }else {
        echo "<br>";
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>