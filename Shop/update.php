<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
	session_start();
	$shop_username = $_SESSION["S_username"];
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'foodpanda';

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$id_food = $_GET["Food_id"];
	echo "$id_food";
	mysqli_set_charset($conn, "utf8");
	$strSQL = "SELECT * FROM food WHERE id_food = '".$_GET["Food_id"]."' ;";
	$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysqli_fetch_array($objQuery);
?>
	<form name="form1" method="post" action="update_data.php?id_food=<?php echo $_GET["Food_id"];?>" enctype="multipart/form-data">
	Edit Picture :<br>
	Name : <input type="text" name="food_name" value="<?php echo $objResult["Food_name"];?>"><br>
	<img src="myfile/<?php echo $objResult["Food_image"];?>"><br>
	Picture : <input type="file" name="filUpload"><br>
	<input type="hidden" name="hdnOldFile" value="<?php echo $objResult["Food_image"];?>">
	Size: <input type="text" name="food_size" value="<?php echo $objResult["Food_size"];?>"><br>
	Cash : <input type="text" name="food_cash" value="<?php echo $objResult["Food_price"];?>"><br>
	<input name="btnSubmit" type="submit" value="Submit">
	</form>
</body>
</html>