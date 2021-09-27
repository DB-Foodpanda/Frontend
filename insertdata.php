<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
*/ ?>
<?php
require('connect.php');
$errors = array();

$C_name		  = $_REQUEST['C_name'];
$C_surname		  = $_REQUEST['C_surname'];
$C_tel		  = $_REQUEST['C_tel'];
$A_detail	  = $_REQUEST['A_detail'];
$C_email	  = $_REQUEST['C_email'];
$C_username		  = $_REQUEST['C_username'];
$C_password		  = $_REQUEST['C_password'];

// ดัก ERROR USERNAME, TEL, EMAIL กรณีมีซ้ำกัน

// $user_check = "SELECT * FROM `customer` WHERE C_username = '$C_username' OR C_tel = '$C_tel' OR C_email = '$C_email' LIMIT 1";
// $query = mysqli_query($conn,$user_check);
// $result = mysqli_fetch_assoc($query);

// mysqli_query($conn, $sql);
// if($result){
// 	if($result['C_username'] == $C_username){
// 		array_push($errors,"มีชื่อผู้ใช้งานนี้แล้ว");
// 		$_SESSION['error'] = "มีชื่อผู้ใช้งานนี้แล้ว";
// 		$warning ='<script>
// 		alert( "มีชื่อผู้ใช้งานนี้แล้ว!");
//  		</script>';
// 	}
// 	if($result['C_tel'] == $C_tel){
// 		array_push($errors,"เบอร์โทรนี้มีผู้ใช้แล้ว");
// 		$_SESSION['error'] = "เบอร์โทรนี้มีผู้ใช้แล้ว";
// 		$warning = '<script>
// 		alert( "เบอร์โทรนี้มีผู้ใช้แล้ว");
//  		</script>';
// 	}
// 	if($result['C_email'] == $C_email){
// 		array_push($errors,"อีเมลนี้มีผู้ใช้แล้ว");
// 		$_SESSION['error'] = "อีเมลนี้มีผู้ใช้แล้ว";
// 		$warning ='<script>
// 		alert( "อีเมลนี้มีผู้ใช้แล้ว");
//  		</script>';
// 	} 
// 	// print_r ($warning);
// 	foreach ($errors as $a){
// 		// echo $a."<br />";
// 		echo '<script  type="text/javascript"> alert('$a."<br />"')</script>';
// 	} 
// 	// echo '<script> window.location.href="register.php"; </script>';
// }
if(count($errors) == 0){
	$sql = "
	INSERT INTO `customer`(`C_username`, `C_password`, `C_name`, `C_surname`, `C_tel`, `C_email`)
 	VALUES ('$C_username', '$C_password', '$C_name', '$C_surname', '$C_tel', '$C_email');
 	";

	$objQuery = mysqli_query($conn, $sql);

	$sql1 = "
	INSERT INTO address(A_detail)
	VALUES ('$A_detail');
	";
    $objQuery = mysqli_query($conn, $sql1);

	echo '<script>
	alert( "Successful registration!");
  	window.location.href="index.php";
 	</script>';
}
// print_r ($C_username);

//$objQuery = mysqli_query($conn, $sql);

// if ($objQuery) {
// 	// alert("Successful registration!");
// 	echo '<script>
// 	alert( "Successful registration!");
// 	window.location.href="index.php";
// 	</script>';
// } else {
// 	print_r($objQuery);
// }

mysqli_close($conn); // ปิดฐานข้อมูล
echo "<br><br>";
echo "--- END ---";
?>