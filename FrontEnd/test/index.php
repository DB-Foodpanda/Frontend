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
    <title>Foodpanda register form</title>
    

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
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
        // $dbservername = "localhost";
        // $dbname="foodpanda";
        // $dbusername="root";
        // $dbpassword="";
        // $conn = new PDO("mysql:host=$dbservername;dbname=$dbname",$dbusername,$dbpassword);

        // $startid = "C-";
        // $tablename = "foodpanda";
        // $startnumber="SELECT MAX(C_id) FROM customer";
        // echo "$startnumber";
        // $startnumber =($startnumber+1);

        // $autoid = $startid.$startnumber;
    ?>
</head>

<body>
    <form action="logindata.php">
        
        <div class="page-wrapper p-t-180 p-b-100 font-robo" style= "background: #FF99CC"> 
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form method="POST">
                            <img src="images/foodpanda.png" width="250px"height="250px">
                            <!--<div class="input-group">
                                <input class="input--style-2" type="text" name ="ID_Cus" disabled="disabled" value="<?=$autoid?>">
                            </div>-->
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="username" name="C_username" Required>
                            </div>
                            <div class="input-group">
                                <input class="input--style-2" type="password" placeholder="password" name="C_password" Required>
                            </div>
                            <!--<div class="input-group">
                            <tr>
                                <td><select id="province" class="input--style-2">
                                <option>- กรุณาเลือกจังหวัด -</option>
                                </select></td>
                            </tr>
                            <tr>
                                    <td><select id="amphur" class="input--style-2">
                                    <option>- กรุณาเลือกเขต/อำเภอ -</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td><select id="district" class="input--style-2">
                                    <option>- กรุณาเลือกแขวง/ตำบล -</option>
                                    </select></td>
                                </tr>
                            </div>-->
                            <div class="p-t-30 center">
                                <button class="btn btn--radius " style= "background: deeppink" type="submit">Login</button><br><br>
                                Not a member? <br><br>
                                <a href="register.php" target="_blank" rel="">Register for member</a><br>
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
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->