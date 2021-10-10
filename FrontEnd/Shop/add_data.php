<html>
<head>
<title>Shopfoodpanda | Add_data</title>
</head>
<body>
<?php
	require('../connect.php');
	session_start();
	$shop_username = $_SESSION["shop_username"];
	$shop_id = $_SESSION["shop_id"];

	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";

		mysqli_set_charset($conn, "utf8");

		$food_name = $_REQUEST["food_name"];
		$food_size = $_REQUEST["food_size"];
		$food_price = $_REQUEST["food_price"];
		$food_detail = $_REQUEST["food_detail"];
		$food_type = $_REQUEST["food_type"];

		
		$strSQL = "INSERT INTO food";
		$strSQL .="(food_name,food_size,food_price,food_image,food_detail,food_type,shop_id)
		VALUES ('$food_name','$food_size','$food_price','".$_FILES["filUpload"]["name"]."','$food_detail','$food_type','$shop_id')";
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