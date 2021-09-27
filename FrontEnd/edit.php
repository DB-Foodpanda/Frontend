<?php
session_start();
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Grab_present/index.php");
    exit;
}*/
require('connect.php');
$cus_username = $_SESSION["cus_username"]; 
$sql = "
SELECT * FROM `customer` 
JOIN customer_status 
ON customer.ID_Cus_Status = customer_status.ID_Cus_Status 
WHERE Cus_username = '$cus_username' ;
  ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);


  $sql_pre = "
SELECT * FROM `customer` 
WHERE Cus_username = '$cus_username' ;
  ";

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
    <title>Grab register form</title>

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
    <?php
        /*$dbservername = "localhost";
        $dbname="grab";
        $dbusername="root";
        $dbpassword="";
        $conn = new PDO("mysql:host=$dbservername;dbname=$dbname",$dbusername,$dbpassword);

        $startid = "CUS-";
        $tablename = "grab";
        $startnumber="SELECT MAX(ID_Cus) FROM customer";
        echo "$startnumber";
        $startnumber =($startnumber+1);

        $autoid = $startid.$startnumber;*/
    ?>
</head>

<body>
    
    <form action="updatedata.php">
        
        <div class="page-wrapper bg-green p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form method="POST">
                            <img src="images/grabfood.png" width="250px"height="250px">
                            <div class="input-group">
                                <input class="input--style-2" type="text" name ="ID_Cus" disabled="disabled" value=<?php 
                         $cus_username = $_SESSION["cus_username"]; 
                         echo $cus_username
                    ?>>
                            </div>
                            <div class="input-group">
                                <input class="input--style-2" type="text" Required placeholder="Name" name="cus_name" pattern="(([\u0E01-\u0E4C]+)(\s+)([\u0E01-\u0E4C]+))||(([A-Za-z]+)(\s+)([A-Za-z]+))" 
                                value="<?php echo $objResult_pre["Cus_Name"] ?>">
                            </div>
                            <div class="input-group">
                                <input class="input--style-2" type="text" Required placeholder="Tel" name="cus_tel" pattern="[0-9]{10}" 
                                value=<?php echo $objResult_pre["Cus_tel"] ?>>
                            </div>
                            <div class="input-group">
                                <input class="input--style-2" type="text" Required placeholder="address" name="cus_address" 
                                value=<?php echo $objResult_pre["Cus_address"] ?>>    
                            </div>
                            <div class="input-group">
                                <input class="input--style-2" type="email" Required placeholder="Email" name="cus_email" 
                                value=<?php echo $objResult_pre["Cus_email"] ?>>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" id="password-field" Required type="password" class="form-control" name="cus_old_password" >
                                </div>
                            </div>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" id="password-field" type="password" class="form-control" name="cus_new_password" >
                                </div>
                            </div>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="Credit card number" name="Cus_credit_card_number" pattern="[0-9]{16}"
                                value=<?php echo $objResult_pre["Cus_credit_card_number"] ?>>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="date" placeholder="expired date" class="form-control" name="Cus_credit_card_exp_date"
                                    value=<?php echo $objResult_pre["Cus_credit_card_exp_date"] ?> >
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="CVV code" class="form-control" name="cus_credit_card_CVV" pattern="[0-9]{3}"
                                    value=<?php echo $objResult_pre["cus_credit_card_CVV"] ?>>
                                </div>
                            </div>


                            <?php
                            
                                if(!(isset($objResult["ID_Cus_Status"]))){
                                $sql = '
                                    SELECT *
                                    FROM customer_status;
                                ';
                                $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
                            echo'<select name="ID_Cus_Status" Required class="form-control">';
                                    while ($objResult = mysqli_fetch_array($objQuery)) {
                                echo'<option value='.$objResult["ID_Cus_Status"].'>';
                                echo $objResult["type_cus_status"].'</option>';
                                }
                            echo'</select>';
                                }
                                else{
                                    echo'<div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" disabled placeholder="type_cus_status"
                                     class="form-control" name="type_cus_status"
                                    value='.$objResult["type_cus_status"].'>
                                </div>
                            </div>';
                                }
                            ?>
                

                            <div class="p-t-30">
                                <button class="btn btn--radius btn--green" type="submit">Register</button>
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