<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	session_start();
	$shop_username = $_SESSION["shop_username"];
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'grab';

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$id_food = $_GET["id_food"];
	echo "$id_food";
	mysqli_set_charset($conn, "utf8");
	$strSQL = "SELECT * FROM food WHERE id_food = '".$_GET["id_food"]."' ;";
	$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysqli_fetch_array($objQuery);
?>
	<form name="form1" method="post" action="update_data.php?id_food=<?php echo $_GET["id_food"];?>" enctype="multipart/form-data">
	Edit Picture :<br>
	Name : <input type="text" name="food_name" value="<?php echo $objResult["food_name"];?>"><br>
	<img src="myfile/<?php echo $objResult["FilesName"];?>"><br>
	Picture : <input type="file" name="filUpload"><br>
	<input type="hidden" name="hdnOldFile" value="<?php echo $objResult["FilesName"];?>">
	Size: <input type="text" name="food_size" value="<?php echo $objResult["food_size"];?>"><br>
	Cash : <input type="text" name="food_cash" value="<?php echo $objResult["food_cash"];?>"><br>
	<input name="btnSubmit" type="submit" value="Submit">
	</form>
</body>
</html>