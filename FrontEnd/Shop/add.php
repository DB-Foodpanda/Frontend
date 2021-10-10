<html>
<head>
<title>Shop | Add</title>
<?php
	require('../connect.php');
	session_start();
	$shop_username = $_SESSION["shop_username"];

		
		mysqli_set_charset($conn, "utf8");
		$sql="SELECT * FROM food WHERE (shop_username = '$shop_username');";

		if ($result=mysqli_query($conn,$sql))
  		{
  			// Return the number of rows in result set
  			$rowcount=mysqli_num_rows($result);
  			// Free result set
  			mysqli_free_result($result);
		  }
?>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-style-3">
    <fieldset><legend>Product</legend>
        <form name="form1" method="post" action="add_data.php" enctype="multipart/form-data">
        <label for="field1"><input type="text" hidden name="shop_username" value=<?php echo $shop_username ?>><br><br>
        <span>Name : <span class="required">*</span></span><input type="text" name="food_name" value=""><br><br>
        <span>Size : <span class="required">*</span></span><input type="text" name="food_size"><br><br>
        <span>Cash : <span class="required">*</span></span><input type="text" name="food_price"><br><br>
        <span>Picture : </span><input type="file" name="food_image"><br><br></label>
        <input name="btnSubmit" type="submit" value="Submit">
		<div class="character-with-form">
			<div class="panda">
				<img src="../images/panda.png">
			</div>
		</div>
        </form>
	</div>
</body>
</html>