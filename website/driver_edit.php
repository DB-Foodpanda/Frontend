<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
require('../connect.php');
session_start();

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];

    $driver_name	  = $_REQUEST['driver_name'];
    $driver_tel		  = $_REQUEST['driver_tel'];
    $driver_password  = $_REQUEST['driver_password'];
    $driver_earnacc_no = $_REQUEST['driver_earnacc_no'];
    $driver_username = $_SESSION["driver_username"];
    $driver_workstatus = $_REQUEST["driver_workstatus"];

if($driver_password==""){
    $sql = "
    UPDATE `driver`
    SET `driver_name`='$driver_name', `driver_tel`='$driver_tel',`driver_earnacc_no`='$driver_earnacc_no',`driver_workstatus`='$driver_workstatus'
    WHERE driver_username = '$driver_username';
    ";
    // echo $sql;

    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: driver.php");
        exit;
    }else {
	    echo "Error : Input";
    }

}
else{
    $sql = "
    UPDATE `driver`
    SET `driver_password`='$driver_password',
    `driver_name`='$driver_name',
    `driver_tel`='$driver_tel',
    `driver_earnacc_no`='$driver_earnacc_no',
    `driver_workstatus`='$driver_workstatus'
    WHERE driver_username = '$driver_username'; 
        ";
         echo $sql;

    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: driver.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }
}

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>