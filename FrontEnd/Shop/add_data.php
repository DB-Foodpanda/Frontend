<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	session_start();
	$shop_username = $_SESSION["S_username"];
	if(move_uploaded_file($_FILES["Food_image"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'foodpanda';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$food_name = $_REQUEST["Food_name"];
		$food_size = $_REQUEST["Food_size"];
		$food_cash = $_REQUEST["Food_price"];

		

		$strSQL = "INSERT INTO food ";
		$strSQL .="(Food_name,Food_size,Food_price,S_username,Food_image) 
		VALUES ('$food_name','$food_size','$food_cash','$shop_username','".$_FILES["Food_image"]["name"]."') ;";
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