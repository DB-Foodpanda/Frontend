<html>
<head>
<title>Shopfoodpanda | Edit</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	
<?php
	session_start();
	$shop_username = $_SESSION["shop_username"];

	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'foodpanda';

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	mysqli_set_charset($conn, "utf8");
	$strSQL = "SELECT * FROM food WHERE shop_username='$shop_username'";
	if(isset($_GET['shop_name'])){
		$name = $_GET['shop_name'];
		$strSQL .= " AND shop_name LIKE '%".$name."%'";
	}
	$objQuery = mysqli_query($conn,$strSQL) or die ("Error Query [".$strSQL."]");
?>
<form action="search.php" method="post">
<input type="text" name="keyword" id="keyword">
	<button type="submit">search</button>
</form>
<table width="340" border="1">
<tr>
<th width="150"> <div align="center">Picture</div></th>
<th width="150"> <div align="center">Name</div></th>
<th width="150"> <div align="center">size</div></th>
<th width="150"> <div align="center">cash</div></th>
</tr>
<?php
	while($objResult = mysqli_fetch_array($objQuery))
	{
?>
<tr>
<td><center><img src="myfile/<?php echo $objResult["Food_image"];?>" width="100px" ,height="100px"></center></td>
<td><center><?php echo $objResult["food_name"];?></center></td>
<td><center><?php echo $objResult["food_size"];?></center></td>
<td><center><?php echo $objResult["food_price"];?></center></td>
<td><center><a href="update.php?id_food=<?php echo $objResult["food_id"];?>">Edit</a></center></td>
<td><center><a href="delete.php?id_food=<?php echo $objResult["food_id"];?>">Delete</a></center></td>
</tr>
<?php
	}
?>
</table>
<a href="add.php"><input type="button" value="เพิ่ม"></a>
<?php
mysqli_close($conn);
?>
</body>
</html>