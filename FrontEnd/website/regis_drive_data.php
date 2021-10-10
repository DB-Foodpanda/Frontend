<?php
    session_start();
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'foodpanda';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$driver_username = $_REQUEST["driver_username"];
		$driver_password = $_REQUEST["driver_password"];
        $driver_name = $_REQUEST["driver_name"];
		$driver_surname = $_REQUEST["driver_surname"];
        $driver_tel = $_REQUEST["driver_tel"];
		$driver_earnacc_no = $_REQUEST["driver_earnacc_no"];


        echo $driver_username;
        echo $driver_password;
        echo $driver_name;
		echo $driver_surname;
        echo $driver_tel;
        echo $driver_earnacc_no;


		$strSQL = "INSERT INTO driver";
		$strSQL .="(`driver_username`, `driver_password`, `driver_name`, `driver_surname`, `driver_tel`, `driver_earnacc_no`) 
		VALUES ('$driver_username','$driver_password','$driver_name','$driver_surname','$driver_tel','$driver_earnacc_no') ;";
		$objQuery = mysqli_query($conn,$strSQL);		
    mysqli_close($conn);
    echo "complete";
	header("location:../index.php");
?>