<html>
<head>
<title>Foodpanda-admin</title>
</head>
<body>
<?php
    require('../connect.php');
	session_start();
        
        $shop_username = $_SESSION["shop_username"];
        $shop_password = $_REQUEST["shop_password"];
        $shop_name = $_REQUEST["shop_name"];
        $shop_tel = $_REQUEST["shop_tel"];
        $shop_address = $_REQUEST["shop_address"];
        $shop_earnacc_no = $_REQUEST["shop_earnacc_no"];
        $shop_openday = $_REQUEST["shop_openday"];
        $shop_opentime = $_REQUEST["shop_opentime"];
        $shop_closetime = $_REQUEST["shop_closetime"];
        $shop_workstatus = $_REQUEST["shop_workstatus"];
        // print_r($shop_username);


		if(!($shop_password=="")){
            $strSQL = "UPDATE shop SET `shop_password`='$shop_password',`shop_name`='$shop_name',`shop_address`='$shop_address',`shop_tel`='$shop_tel',
            `shop_workstatus` = '$shop_workstatus',`shop_earnacc_no`='$shop_earnacc_no',`shop_openday`='$shop_openday',`shop_opentime`='$shop_opentime',
            `shop_closetime`='$shop_closetime'
            WHERE shop_username='$shop_username'";
            echo $strSQL;
		    $objQuery = mysqli_query($conn,$strSQL);
        }
        else{
            $strSQL = "UPDATE shop SET `shop_name`='$shop_name',`shop_address`='$shop_address',`shop_tel`='$shop_tel',
            `shop_workstatus` = '$shop_workstatus',`shop_earnacc_no`='$shop_earnacc_no',`shop_openday`='$shop_openday',`shop_opentime`='$shop_opentime',
            `shop_closetime`='$shop_closetime'
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
                $strSQL .=" SET shop_image = '".$_FILES["filUpload"]["name"]."' WHERE shop_username = '$shop_username' ";
                $objQuery = mysqli_query($conn,$strSQL);		
    
                echo "Copy/Upload Complete<br>";
    
            }
        }
	header("location:Home.php");
?>
</body>
</html>