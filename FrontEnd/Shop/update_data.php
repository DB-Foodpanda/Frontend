<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
	session_start();

		//*** Update Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'foodpanda';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		$strSQL = "UPDATE food ";
		$strSQL .=" SET Food_name = '".$_POST["Food_name"]."',Food_size = '".$_POST["Food_size"]."',Food_price = '".$_POST["Food_price"]."' WHERE Food_id = '".$_GET["Food_id"]."' ";
		$objQuery = mysqli_query($conn,$strSQL);		
	
	if($_FILES["Food_image"]["name"] != "")
	{
		if(move_uploaded_file($_FILES["Food_image"]["tmp_name"],"myfile/".$_FILES["Food_image"]["name"]))
		{

			//*** Delete Old File ***//			
			@unlink("myfile/".$_POST["hdnOldFile"]);
			
			//*** Update New File ***//
			$strSQL = "UPDATE food ";
			$strSQL .=" SET Food_image = '".$_FILES["Food_image"]["name"]."' WHERE Food_id = '".$_GET["Food_id"]."' ";
			$objQuery = mysqli_query($conn,$strSQL);		

			echo "Copy/Upload Complete<br>";

		}
	}
	header("location:Home.php?state=1");
?>
</body>
</html>