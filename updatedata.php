<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
Created by Mr.Earn SURIYACHAY | ComSci | KMUTNB | Bangkok | Apr 2018 */ ?>
<?php
session_start();
require('connect.php');

//$EmployeeID   = $_REQUEST['EmployeeID'];
//$Title		  = $_REQUEST['Title'];
$cus_username = $_SESSION["cus_username"]; 

$cus_name		  = $_REQUEST['cus_name'];
$cus_tel		  = $_REQUEST['cus_tel'];
$cus_address	  = $_REQUEST['cus_address'];
$cus_email	  = $_REQUEST['cus_email'];
$cus_old_password	      = $_REQUEST['cus_old_password'];
$cus_new_password		  = $_REQUEST['cus_new_password'];
$Cus_credit_card_number = $_REQUEST['Cus_credit_card_number'];
$Cus_credit_card_exp_date = $_REQUEST['Cus_credit_card_exp_date'];
$cus_credit_card_CVV = $_REQUEST['cus_credit_card_CVV'];
$ID_Cus_Status = $_REQUEST['ID_Cus_Status'];

$cus_username = $_SESSION["cus_username"]; 
  $sql = "
  SELECT * FROM `customer` WHERE Cus_username = '$cus_username' ;
    ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);
  $cus_username = $_SESSION["cus_username"];
if($cus_old_password==$objResult["Cus_password"]){
    if($cus_new_password==""){
      $sql = "
        UPDATE customer
        SET Cus_Name = '$cus_name',  
        Cus_tel = '$cus_tel', 
        Cus_address = '$cus_address', 
        Cus_email = '$cus_email', 
        Cus_credit_card_number = '$Cus_credit_card_number', 
        Cus_credit_card_exp_date = '$Cus_credit_card_exp_date',
        cus_credit_card_CVV ='$cus_credit_card_CVV',
        ID_Cus_Status = '$ID_Cus_Status'
        WHERE cus_username = '$cus_username' ; 
	    ";

    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: ../Grab_present/Home/index.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }
    }
    else{
      $sql = "
        UPDATE customer
        SET Cus_Name = '$cus_name',  
        Cus_tel = '$cus_tel', 
        Cus_address = '$cus_address', 
        Cus_email = '$cus_email', 
        Cus_password = '$cus_new_password', 
        Cus_credit_card_number = '$Cus_credit_card_number', 
        Cus_credit_card_exp_date = '$Cus_credit_card_exp_date',
        cus_credit_card_CVV ='$cus_credit_card_CVV',
        ID_Cus_Status = '$ID_Cus_Status'
        WHERE cus_username = '$cus_username' ; 
	    ";

    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
	    header("Location: ../Grab_present/Home/index.php"); 
        exit;
    }else {
	    echo "Error : Input";
    }
    }
}
else{
    echo '<script>
            alert("Sign In Error\nSorry, your old password is incorrect\n Please try again");
            </script>';
}

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>