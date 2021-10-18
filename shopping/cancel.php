<?php
session_start();
require('../connect.php');

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$order_id = $_GET["id"];
$order_status = 5;

    $sql = "UPDATE `order` SET `order_status`= $order_status ,order_dateendsend = NOW() WHERE order_id = '$order_id'";
    echo $sql;
    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: ./monitor_order.php?order_status=5"); 
        exit;
    }else {
	    echo "Error : Input";
    }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>