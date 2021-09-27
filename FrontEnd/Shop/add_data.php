<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	session_start();
	$shop_username = $_SESSION["shop_username"];
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

		$food_name = $_REQUEST["food_name"];
		$food_size = $_REQUEST["food_size"];
		$food_cash = $_REQUEST["food_cash"];

		

		$strSQL = "INSERT INTO food ";
		$strSQL .="(food_name,food_size,food_cash,shop_username,FilesName) 
		VALUES ('$food_name','$food_size','$food_cash','$shop_username','".$_FILES["filUpload"]["name"]."') ;";
		$objQuery = mysqli_query($conn,$strSQL);		
	}
	else{
		echo "1234555555555";
	}
	mysqli_close($conn);
	header("location:Home.php?state=1");
?>
</body>
</html>