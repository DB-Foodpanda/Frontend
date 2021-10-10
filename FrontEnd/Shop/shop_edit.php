<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
	session_start();

		//*** Update Record ***//
		$servername = 'localhost';
		$username = 'root';
		$password = '';
        $dbname = 'foodpanda';
        
        $shop_username = $_SESSION["S_username"];
        $shop_password = $_REQUEST["S_password"];
        $shop_name = $_REQUEST["S_name"];
        $shop_tel = $_REQUEST["S_tel"];
        $shop_address = $_REQUEST["S_address"];
        $shop_earn_acc_no = $_REQUEST["S_earnacc_no"];
        $shop_business_time_day = $_REQUEST["S_openday"];
        $shop_business_time_open_time = $_REQUEST["S_opentime"];
        $shop_business_time_close_time = $_REQUEST["S_closetime"];



		$conn = mysqli_connect($servername, $username, $password, $dbname);

		mysqli_set_charset($conn, "utf8");

		if(!($shop_password=="")){
            $strSQL = "UPDATE shop ";
            $strSQL .=" SET `S_password`='$shop_password',`S_name`='$shop_name',`S_address`='$shop_address',`S_tel`='$shop_tel',
            `S_earnacc_no`='$shop_earn_acc_no',`S_openday`='$shop_business_time_day',`S_opentime`='$shop_business_time_open_time',
            `S_closetime`='$shop_business_time_close_time'
            WHERE S_username='$shop_username'";
            echo $strSQL;
		    $objQuery = mysqli_query($conn,$strSQL);
        }
        else{
            $strSQL = "UPDATE shop ";
        $strSQL .=" SET `S_name`='$shop_name',`S_address`='$shop_address',`S_tel`='$shop_tel',
        `S_earnacc_no`='$shop_earn_acc_no',`S_openday`='$shop_business_time_day',`S_opentime`='$shop_business_time_open_time',
        `S_closetime`='$shop_business_time_close_time'
        WHERE S_username='$shop_username'";
		$objQuery = mysqli_query($conn,$strSQL);
        }
        if($_FILES["S_image"]["name"] != "")
        {
            if(move_uploaded_file($_FILES["S_image"]["tmp_name"],"myfile/".$_FILES["S_image"]["name"]))
            {
    
                //*** Delete Old File ***//			
                @unlink("myfile/".$_POST["hdnOldFile"]);
                
                //*** Update New File ***//
                $strSQL = "UPDATE shop ";
                $strSQL .=" SET S_image = '".$_FILES["S_image"]["name"]."' WHERE S_username = '$shop_username' ";
                $objQuery = mysqli_query($conn,$strSQL);		
    
                echo "Copy/Upload Complete<br>";
    
            }
        }
	header("location:Home.php");
?>
</body>
</html>