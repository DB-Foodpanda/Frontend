<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	session_start();

		//*** Update Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'grab';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$strSQL = "UPDATE food ";
		$strSQL .=" SET food_name = '".$_POST["food_name"]."',food_size = '".$_POST["food_size"]."',food_cash = '".$_POST["food_cash"]."' WHERE id_food = '".$_GET["id_food"]."' ";
		$objQuery = mysqli_query($conn,$strSQL);		
	
	if($_FILES["filUpload"]["name"] != "")
	{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
		{

			//*** Delete Old File ***//			
			@unlink("myfile/".$_POST["hdnOldFile"]);
			
			//*** Update New File ***//
			$strSQL = "UPDATE food ";
			$strSQL .=" SET FilesName = '".$_FILES["filUpload"]["name"]."' WHERE id_food = '".$_GET["id_food"]."' ";
			$objQuery = mysqli_query($conn,$strSQL);		

			echo "Copy/Upload Complete<br>";

		}
	}
	header("location:Home.php?state=1");
?>
</body>
</html>