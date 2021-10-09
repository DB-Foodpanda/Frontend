<?php
    session_start();
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'grab';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$driver_username = $_REQUEST["driver_username"];
		$driver_password = $_REQUEST["driver_password"];
        $driver_name = $_REQUEST["driver_name"];
        $driver_tel = $_REQUEST["driver_tel"];
		$driver_earn_acc_no = $_REQUEST["driver_earn_acc_no"];
        $ID_driver_status = $_REQUEST['ID_driver_status'];

        echo $driver_username;
        echo $driver_password;
        echo $driver_name;
        echo $driver_tel;
        echo $driver_earn_acc_no;
        echo $ID_driver_status;

		$strSQL = "INSERT INTO driver";
		$strSQL .="(`driver_username`, `driver_password`, `driver_name`, `driver_tel`, `driver_earn_acc_no`, `ID_driver_status`) 
		VALUES ('$driver_username','$driver_password','$driver_name','$driver_tel','$driver_earn_acc_no','$ID_driver_status') ;";
		$objQuery = mysqli_query($conn,$strSQL);		
    mysqli_close($conn);
    echo "complete";
	header("location:../index.php");
?>