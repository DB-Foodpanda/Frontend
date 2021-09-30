<?php /* *** No Copyright for Education (Free to Use and Edit) *** * /
PHP 7.1.1 | MySQL 5.7.17 | phpMyAdmin 4.6.6 | by appserv-win32-8.6.0.exe
*/ ?>
<?php
require('connect.php');
$errors = array();

$cus_name		  = $_REQUEST['cus_name'];
$cus_surname		  = $_REQUEST['cus_surname'];
$cus_birthday		  = $_REQUEST['cus_birthday'];
$cus_tel		  = $_REQUEST['cus_tel'];
$cus_email	  = $_REQUEST['cus_email'];
$cus_username		  = $_REQUEST['cus_username'];
$cus_password		  = $_REQUEST['cus_password'];
$address_detail	  = $_REQUEST['address_detail'];
// echo($address_detail);


// ดัก ERROR USERNAME, TEL, EMAIL กรณีมีซ้ำกัน

// $user_check = "SELECT * FROM `customer` WHERE C_username = '$C_username' OR C_tel = '$C_tel' OR C_email = '$C_email' LIMIT 1";
// $query = mysqli_query($conn,$user_check);
// $result = mysqli_fetch_assoc($query);

// // mysqli_query($conn, $sql);
// if($result){
// 	if($result['C_username'] == $C_username){
// 		array_push($errors,"มีชื่อผู้ใช้งานนี้แล้ว");
// 		$_SESSION['error'] = "มีชื่อผู้ใช้งานนี้แล้ว";
// 		$warning[] ='<script>
// 		alert( "มีชื่อผู้ใช้งานนี้แล้ว!");
//  		</script>';
// 	}
// 	if($result['C_tel'] == $C_tel){
// 		array_push($errors,"เบอร์โทรนี้มีผู้ใช้แล้ว");
// 		$_SESSION['error'] = "เบอร์โทรนี้มีผู้ใช้แล้ว";
// 		$warning[] = '<script>
// 		alert( "เบอร์โทรนี้มีผู้ใช้แล้ว");
//  		</script>';
// 	}
// 	if($result['C_email'] == $C_email){
// 		array_push($errors,"อีเมลนี้มีผู้ใช้แล้ว");
// 		$_SESSION['error'] = "อีเมลนี้มีผู้ใช้แล้ว";
// 		$warning[] ='<script>
// 		alert( "อีเมลนี้มีผู้ใช้แล้ว");
//  		</script>';
// 	}
// 	print_r ($warning);
// 	echo '<script> window.location.href="register.php"; </script>';
// }


// print_r($addrinsertresults);
// echo($addrinsertresults);


if(count($errors) == 0){
	$customerinsert = "
	INSERT INTO `customer`(`cus_username`, `cus_password`, `cus_name`, `cus_surname`, `cus_birthday`, `cus_tel`, `cus_email`)
 	VALUES ('$cus_username', '$cus_password', '$cus_name', '$cus_surname', '$cus_birthday', '$cus_tel', '$cus_email');
 	";

	$objQuery = mysqli_query($conn, $customerinsert);
	$getinsertcusid = mysqli_insert_id($conn);
	// echo($getinsertcusid);

	
	$addrinsert = "INSERT INTO address(address_detail, cus_id) VALUES ('$address_detail', $getinsertcusid)";
	$addrinsertresults = mysqli_query($conn, $addrinsert);
	// printf($addrinsertresults);

	// echo '<script>
	// alert( "Successful registration!");
 	// </script>';
	// print_r($address_detail);
}
// print_r ($errors);

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
echo "<br>";
echo "Successful registration!";
echo "<br><br>";
echo "--- END ---";
?>