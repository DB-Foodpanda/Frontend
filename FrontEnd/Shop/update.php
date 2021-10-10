<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
	require('../connect.php');
	session_start();
	$shop_username = $_SESSION["shop_username"];
	$id_food = $_GET["food_id"];
	echo "$id_food";
	mysqli_set_charset($conn, "utf8");
	$strSQL = "SELECT * FROM food WHERE id_food = '".$_GET["food_id"]."' ;";
	$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysqli_fetch_array($objQuery);
?>
	<form name="form1" method="post" action="update_data.php?id_food=<?php echo $_GET["food_id"];?>" enctype="multipart/form-data">
	Edit Picture :<br>
	Name : <input type="text" name="food_name" value="<?php echo $objResult["food_name"];?>"><br>
	<img src="myfile/<?php echo $objResult["food_image"];?>"><br>
	Picture : <input type="file" name="filUpload"><br>
	<input type="hidden" name="hdnOldFile" value="<?php echo $objResult["food_image"];?>">
	Size: <input type="text" name="food_size" value="<?php echo $objResult["food_size"];?>"><br>
	Cash : <input type="text" name="food_price" value="<?php echo $objResult["food_price"];?>"><br>
	<input name="btnSubmit" type="submit" value="Submit">
	</form>
</body>
</html>