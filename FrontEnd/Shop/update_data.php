<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
	require('../connect.php');
	session_start();

		// mysqli_set_charset($conn, "utf8");
		
		
		$strSQL = "UPDATE food";
		$strSQL .=" SET food_name = '".$_POST["food_name"]."',food_size = '".$_POST["food_size"]."',food_price = '".$_POST["food_price"]."',food_detail = '".$_POST["food_detail"]."' WHERE food_id = '".$_GET["food_id"]."' ";
		$objQuery = mysqli_query($conn,$strSQL);		
		// print_r ($_GET["food_id"]);
	if($_FILES["filUpload"]["name"] != "")
	{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
		{

			//*** Delete Old File ***//			
			@unlink("myfile/".$_POST["hdnOldFile"]);
			
			//*** Update New File ***//
			$strSQL = "UPDATE food";
			$strSQL .=" SET food_image = '".$_FILES["filUpload"]["name"]."' WHERE food_id = '".$_GET["food_id"]."' ";
			$objQuery = mysqli_query($conn,$strSQL);		

			echo "Copy/Upload Complete<br>";

		}
	}
     header("location:Home.php?state=1");
?>
</body>
</html>