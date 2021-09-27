<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	session_start();

		//*** Update Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
        $dbname = 'grab';
        
        $shop_username = $_SESSION["shop_username"];
        $shop_password = $_REQUEST["shop_new_password"];
        $shop_name = $_REQUEST["shop_name"];
        $shop_tel = $_REQUEST["shop_tel"];
        $shop_address = $_REQUEST["shop_address"];
        $shop_earn_acc_no = $_REQUEST["shop_earn_acc_no"];
        $shop_business_time_day = $_REQUEST["shop_business_time_day"];
        $shop_business_time_open_time = $_REQUEST["shop_business_time_open_time"];
        $shop_business_time_close_time = $_REQUEST["shop_business_time_close_time"];



		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		if(!($shop_password=="")){
            $strSQL = "UPDATE shop ";
            $strSQL .=" SET `shop_password`='$shop_password',`shop_name`='$shop_name',`shop_address`='$shop_address',`shop_tel`='$shop_tel',
            `shop_earn_acc_no`='$shop_earn_acc_no',`shop_business_time_day`='$shop_business_time_day',`shop_business_time_open_time`='$shop_business_time_open_time',
            `shop_business_time_close_time`='$shop_business_time_close_time'
            WHERE shop_username='$shop_username'";
            echo $strSQL;
		    $objQuery = mysqli_query($conn,$strSQL);
        }
        else{
            $strSQL = "UPDATE shop ";
        $strSQL .=" SET `shop_name`='$shop_name',`shop_address`='$shop_address',`shop_tel`='$shop_tel',
        `shop_earn_acc_no`='$shop_earn_acc_no',`shop_business_time_day`='$shop_business_time_day',`shop_business_time_open_time`='$shop_business_time_open_time',
        `shop_business_time_close_time`='$shop_business_time_close_time'
        WHERE shop_username='$shop_username'";
		$objQuery = mysqli_query($conn,$strSQL);
        }
        if($_FILES["filUpload"]["name"] != "")
        {
            if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
            {
    
                //*** Delete Old File ***//			
                @unlink("myfile/".$_POST["hdnOldFile"]);
                
                //*** Update New File ***//
                $strSQL = "UPDATE shop ";
                $strSQL .=" SET FilesName = '".$_FILES["filUpload"]["name"]."' WHERE shop_username = '$shop_username' ";
                $objQuery = mysqli_query($conn,$strSQL);		
    
                echo "Copy/Upload Complete<br>";
    
            }
        }
	header("location:Home.php");
?>
</body>
</html>