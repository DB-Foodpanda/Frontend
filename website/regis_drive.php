<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>REGISTER DRIVER</title>

    <!-- Icons font CSS-->
    <script src="https://kit.fontawesome.com/a1850e5a9e.js" crossorigin="anonymous"></script>

    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
    <link href="../css/style-register.css" rel="stylesheet" media="all">
    <html xmlns="http://www.w3.org/1999/xhtml">

    
</head>
<body>
<form action="regis_drive_data.php" method="POST">
        
        <div class="page-wrapper p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form class="form-insert">
                            <img src="../images/foodpanda_driver.png">
                            <div class="form-group">
                                <input type="text" name="driver_name" class="form-control" value="" id="name-form4-y">
                                <label class="form-label">Name</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="driver_surname" class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Surname</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="driver_username" class="form-control" value="" id="name-form4-y" >
                                <label class="form-label">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="driver_password" class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Password</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="driver_tel" class="form-control" value="" id="email-form4-v" pattern="[0-9]{10}">
                                <label class="form-label">Tel</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="driver_earnacc_no" class="form-control" value="" id="email-form4-v">
                                <label class="form-label">Account number</label>
                            </div>
                            <button class="btn" type="submit" >Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="AutoProvince.js"></script>

</body>
</html>