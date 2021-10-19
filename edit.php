<?php
session_start();
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Grab_present/index.php");
    exit;
}*/
require('connect.php');
$cus_username = $_SESSION["cus_username"]; 
$sql = " SELECT * FROM `customer` JOIN `address` ON customer.cus_id = address.cus_id WHERE cus_username = '$cus_username' ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);


  $sql_pre = " SELECT * FROM `customer` JOIN `address` ON customer.cus_id = address.cus_id WHERE cus_username = '$cus_username'  ";

  $objQuery_pre = mysqli_query($conn, $sql_pre) or die("Error Query [" . $sql . "]");
  $objResult_pre = mysqli_fetch_array($objQuery_pre);
  
?>


<!DOCTYPE html>
<html>

<head>
    <style>
        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Foodpanda edit form</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <script src="https://kit.fontawesome.com/a1850e5a9e.js" crossorigin="anonymous"></script>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <html xmlns="http://www.w3.org/1999/xhtml">
 </head>

<body>
    
    <form action="updatedata.php">
        
        <div class="page-wrapper bg-green p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form method="POST">
                            <img src="./Home/img/istockphoto-1153447350-170667a.png" >
                            <label for="cus_username">Username:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="text" name ="ID_Cus" disabled="disabled" value=<?php 
                                $cus_username = $_SESSION["cus_username"]; 
                                echo $cus_username
                                ?>>
                            </div>
                            <label for="cus_name">Name:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="text" Required placeholder="Name" name="cus_name"  
                                value="<?php echo $objResult_pre["cus_name"] ?>">
                            </div>
                            <label for="cus_tel">Tel:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="text" Required placeholder="Tel" name="cus_tel" pattern="[0-9]{10}" 
                                value=<?php echo $objResult_pre["cus_tel"] ?>>
                            </div>
                            <label for="cus_birthday">Birthday:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="date" placeholder="Credit card number" name="cus_birthday" pattern="[0-9]{16}"
                                value=<?php echo $objResult_pre["cus_birthday"] ?>>
                            </div>
                            <label for="cus_address">Address:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="textarea" Required placeholder="address" name="address_detail" 
                                value=<?php echo $objResult_pre["address_detail"] ?>>    
                            </div>
                            <label for="cus_email">Email:</label><br>
                            <div class="input-group">
                                <input class="input--style-2" type="email" Required placeholder="Email" name="cus_email" 
                                value=<?php echo $objResult_pre["cus_email"] ?>>
                            </div>
                            <label for="cus_email">Password:</label><br>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" id="password-field" Required type="password" class="form-control" name="cus_password" placeholder="หากไม่เปลี่ยนรหัสให้ใส่รหัสเดิม">
                                </div>
                            </div>
                            <div class="p-t-30">
                                <button class="btn btn--radius btn--green" type="submit">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="AutoProvince.js"></script>
<script>
	$('body').AutoProvince({
		PROVINCE:		'#province', // select div สำหรับรายชื่อจังหวัด
		AMPHUR:			'#amphur', // select div สำหรับรายชื่ออำเภอ
		DISTRICT:		'#district', // select div สำหรับรายชื่อตำบล
		POSTCODE:		'#postcode', // input field สำหรับรายชื่อรหัสไปรษณีย์
		arrangeByName:		true // กำหนดให้เรียงตามตัวอักษร
	});
</script>
<!--use for reveal password field-->
<script>
$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>

<script>
$(".toggle-password1").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->