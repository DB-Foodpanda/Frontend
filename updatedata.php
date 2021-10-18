<?php
session_start();
require('connect.php');

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$cus_username = $_SESSION["cus_username"]; 
$cus_id = $_SESSION["cus_id"];
$cus_name		  = $_REQUEST['cus_name'];
$cus_tel		  = $_REQUEST['cus_tel'];
$cus_birthday = $_REQUEST['cus_birthday'];
$cus_email	  = $_REQUEST['cus_email'];
$cus_password	      = $_REQUEST['cus_password'];
$address_detail = $_REQUEST['address_detail'];

$cus_username = $_SESSION["cus_username"]; 
  $sql = " SELECT * FROM `customer` WHERE Cus_username = '$cus_username' ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);
  $cus_username = $_SESSION["cus_username"];

    if($cus_password==""){
      $sql = " UPDATE customer SET cus_name = '$cus_name',  cus_tel = '$cus_tel', cus_birthday = '$cus_birthday', cus_email = '$cus_email' 
        WHERE cus_username = '$cus_username' ";

      $sql1 = "UPDATE address SET address_detail = '$address_detail' WHERE address.cus_id = '$cus_id'";
      
      $objQuery = mysqli_query($conn, $sql);
      $objQuery = mysqli_query($conn, $sql1);

    if ($objQuery) {
	    header("Location:Home/index.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }
    }
    else{
      $sql = " UPDATE customer SET cus_name = '$cus_name',  cus_tel = '$cus_tel', cus_birthday = '$cus_birthday', cus_email = '$cus_email', cus_password = '$cus_password'
        WHERE cus_username = '$cus_username' ; 
	    ";

      $sql1 = "UPDATE address SET address_detail = '$address_detail' WHERE address.cus_id = '$cus_id'";

      $objQuery = mysqli_query($conn, $sql);
      $objQuery = mysqli_query($conn, $sql1);

    if ($objQuery) {
	      header("Location:Home/index.php"); 
        exit;
    }else {
	    echo "Error : Input";
      }
    }


mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>