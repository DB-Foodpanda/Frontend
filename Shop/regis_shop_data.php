<?php
	require('../connect.php');
    session_start();
	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";
		
		mysqli_set_charset($conn, "utf8");

		$shop_username = $_REQUEST["shop_username"];
		$shop_password = $_REQUEST["shop_password"];
        $shop_name = $_REQUEST["shop_name"];
        $shop_address = $_REQUEST["shop_address"];
		$shop_tel = $_REQUEST["shop_tel"];
		$shop_earnacc_no = $_REQUEST["shop_earnacc_no"];
        $shop_openday = $_REQUEST["shop_openday"];
        $shop_opentime = $_REQUEST["shop_opentime"];
		$shop_closetime = $_REQUEST["shop_closetime"];
		$shop_type = $_REQUEST["type_id"];

		$strSQL = "INSERT INTO shop";
		$strSQL .="(type_id,shop_username,shop_password,shop_name,shop_address,shop_tel,shop_earnacc_no,shop_openday,shop_opentime,shop_closetime,shop_image) 
		VALUES ($shop_type,'$shop_username','$shop_password','$shop_name','$shop_address','$shop_tel','$shop_earnacc_no','$shop_openday','$shop_opentime','$shop_closetime','".$_FILES["filUpload"]["name"]."')";
		$objQuery = mysqli_query($conn,$strSQL);
		
	}
	else{
		echo "1234555555555";
	}
	mysqli_close($conn);
	header("location:../index.php");
?>