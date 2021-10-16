<?php
	require('../connect.php');
    session_start();
		echo "Copy/Upload Complete<br>";
		$errors = array();

		$driver_username = $_REQUEST["driver_username"];
		$driver_password = $_REQUEST["driver_password"];
        $driver_name = $_REQUEST["driver_name"];
		$driver_surname = $_REQUEST["driver_surname"];
        $driver_tel = $_REQUEST["driver_tel"];
		$driver_earnacc_no = $_REQUEST["driver_earnacc_no"];


		$strSQL = "INSERT INTO driver";
		$strSQL .="(`driver_username`, `driver_password`, `driver_name`, `driver_surname`, `driver_tel`, `driver_earnacc_no`) 
		VALUES ('$driver_username','$driver_password','$driver_name','$driver_surname','$driver_tel','$driver_earnacc_no') ;";
		$objQuery = mysqli_query($conn,$strSQL);		

		echo '<script>
	 	alert( "Successful registration!");
		window.location.href="../index.php";
    	</script>';

    mysqli_close($conn); //ปิดฐานข้อมูล
	echo "<br>";
	echo "Successful registration!";
	echo "<br><br>";
	echo "--- END ---"
    // echo "complete";
	// header("location:../index.php");
?>