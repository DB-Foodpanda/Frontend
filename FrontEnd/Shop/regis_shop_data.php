<?php
    session_start();
	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'grab';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$shop_username = $_REQUEST["shop_username"];
		$shop_password = $_REQUEST["shop_password"];
        $shop_name = $_REQUEST["shop_name"];
        $shop_address = $_REQUEST["shop_address"];
		$shop_tel = $_REQUEST["shop_tel"];
		$shop_earn_acc_no = $_REQUEST["shop_earn_acc_no"];
        $shop_business_time_day = $_REQUEST["shop_business_time_day"];
        $shop_business_time_open_time = $_REQUEST["shop_business_time_open_time"];
		$shop_business_time_close_time = $_REQUEST["shop_business_time_close_time"];
		$FilesName = $_REQUEST["filUpload"];
		

		$strSQL = "INSERT INTO shop ";
		$strSQL .="(`shop_username`, `shop_password`, `shop_name`, `shop_address`, `shop_tel`, `shop_earn_acc_no`, `shop_business_time_day`, `shop_business_time_open_time`, `shop_business_time_close_time`, `FilesName`) 
		VALUES ('$shop_username','$shop_password','$shop_name','$shop_address','$shop_tel','$shop_earn_acc_no','$shop_business_time_day','$shop_business_time_open_time','$shop_business_time_close_time','".$_FILES["filUpload"]["name"]."') ;";
		$objQuery = mysqli_query($conn,$strSQL);		
	}
	else{
		echo "1234555555555";
	}
	mysqli_close($conn);
	header("location:../index.php");
?>