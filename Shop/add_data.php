<html>
<head>
<title>Shop | Add_data</title>
</head>
<body>
<?php
	session_start();
	$shop_username = $_SESSION["shop_username"];
	if(move_uploaded_file($_FILES["food_image"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";

		//*** Insert Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'foodpanda';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$food_name = $_REQUEST["food_name"];
		$food_size = $_REQUEST["food_size"];
		$food_price = $_REQUEST["food_price"];

		

		$strSQL = "INSERT INTO food ";
		$strSQL .="(food_name,food_size,food_price,shop_username,food_image) 
		VALUES ('$food_name','$food_size','$food_price','$shop_username','".$_FILES["food_image"]["name"]."') ;";
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