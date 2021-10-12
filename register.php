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
    <title>REGISTER</title>

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
    <link href="css/style-register.css" rel="stylesheet" media="all">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        /*$dbservername = "localhost";
        $dbname="foodpanda";
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
    
    <form action="insertdata.php" method="POST">
        
        <div class="page-wrapper p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form class="form-insert">
                            <img src="images/foodpanda.png">
                            <div class="form-group">
                                <input type="text" class="form-control" name="cus_name"/>
                                <label class="form-label">Name</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cus_surname"/>
                                <label class="form-label">Surname</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Birthday</label>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <input type="date" class="form-control" name="cus_birthday"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cus_tel" pattern="[0-9]{10}"/>
                                <label class="form-label">Tel</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address_detail"/>
                                <label class="form-label">Address</label>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="cus_email"/>
                                <label class="form-label">Email</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cus_username"/>
                                <label class="form-label">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="cus_password"/>
                                <label class="form-label">Password</label>
                            </div>
                            <button class="btn" type="submit">Register</button>
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
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->