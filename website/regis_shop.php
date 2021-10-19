<?php 
    session_start();
    require('../connect.php');
    $sql = " SELECT * FROM `shop` ";
    $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
    $objResult = mysqli_fetch_array($objQuery);
?>

<!DOCTYPE html>
<html  >
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>REGISTER SHOP</title>

    <!-- Icons font CSS-->
    <script src="https://kit.fontawesome.com/a1850e5a9e.js" crossorigin="anonymous"></script>
    

    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
    <link href="../css/style-register.css" rel="stylesheet" media="all">
    <html xmlns="http://www.w3.org/1999/xhtml">
  
  
</head>
<body>
<form action="../Shop/regis_shop_data.php" method="POST" class="mbr-form form-with-styler" enctype="multipart/form-data">
        
        <div class="page-wrapper p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <form class="form-insert">
                            <img src="../images/foodpanda_shop.png">
                            <div class="form-group">
                                <input type="text" name="shop_username" class="form-control" value="" id="name-form4-y" >
                                <label class="form-label">Shop Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="shop_password" class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Shop Password</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shop_name" class="form-control" value="" id="name-form4-y">
                                <label class="form-label">Shop Name</label>
                            </div>
                            <div class="form-group">
                                <select name="type_id" class="form-control"> 
                                    <?php 
                                        $options = $objResult["type_id"];
                                    ?>
                                    <option value="1" <?php if($options== 1) echo 'selected="selected"'; ?> >Thai</option>
                                    <option value="2" <?php if($options== 2) echo 'selected="selected"'; ?> >Coffee & Tea</option>
                                    <option value="3" <?php if($options== 3) echo 'selected="selected"'; ?> >Bakery</option>
                                    <option value="4" <?php if($options== 4) echo 'selected="selected"'; ?> >Chicken</option>
                                    <option value="5" <?php if($options== 5) echo 'selected="selected"'; ?> >Desserts</option>
                                    <option value="6" <?php if($options== 6) echo 'selected="selected"'; ?> >Steak</option>
                                    <option value="7" <?php if($options== 7) echo 'selected="selected"'; ?> >Fast food</option>
                                    <option value="8" <?php if($options== 8) echo 'selected="selected"'; ?> >Japanese</option>
                                    <option value="9" <?php if($options== 9) echo 'selected="selected"'; ?> >Korea</option>
                                    <option value="10" <?php if($options== 10) echo 'selected="selected"'; ?> >Drink</option>
                                </select>
                                <label class="form-label">Shop Type</label><br>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shop_tel"  class="form-control" value="" id="email-form4-y" pattern="[0-9]{10}">
                                <label class="form-label">Tel</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shop_address" class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Address</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shop_earnacc_no" class="form-control" placeholder="เลขบัญชีธนาคาร" value="" id="email-form4-y" >
                                <label class="form-label">Account number</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shop_openday" placeholder="ตัวอย่าง:จ-ศ"  class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Open Days</label>
                            </div>
                            <div class="form-group">
                                <input type="time" name="shop_opentime" class="form-control" value="" id="email-form4-y" >
                                <label class="form-label">Open Time</label>
                            </div>
                            <div class="form-group">
                                <input type="time" name="shop_closetime" class="form-control" value="" id="email-form4-y">
                                <label class="form-label">Close Time</label>
                            </div>
                            <div class="form-group">
                                <label for="filUpload" class="form-label">Shop Profile</label><br><br>
                                <input type="file" name="filUpload" Required>
                            </div>
                            <button class="btn" type="submit" >Register</button>
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