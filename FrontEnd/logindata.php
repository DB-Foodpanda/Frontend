<?php  
    session_start();
    require('connect.php');
    if (isset($_REQUEST['cus_username']) and isset($_REQUEST['cus_password'])){
	
        // Assigning POST values to variables.
        $cus_username = $_REQUEST['cus_username'];
        $cus_password = $_REQUEST['cus_password'];
        // CHECK FOR THE RECORD FROM TABLE
        $query = "SELECT * FROM `customer` WHERE cus_username='$cus_username' and cus_password='$cus_password'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $objResult = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);

        // $query1 = "SELECT * FROM `shop` WHERE shop_username='$cus_username' and shop_password='$cus_password'";
        // $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
        // $objResult1 = mysqli_fetch_array($result1);
        // $count1 = mysqli_num_rows($result1);


        // $query2 = "SELECT * FROM `driver` WHERE driver_username='$cus_username' and driver_password='$cus_password'";
        // $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        // $objResult2 = mysqli_fetch_array($result2);
        // $count2 = mysqli_num_rows($result2);

        // if(isset($objResult["Cus_work_status"])){
        //     if($objResult["Cus_work_status"]==1){
        //         echo '<script>
        //         var str = new String("Sign In Error");
        //         alert(" This Account Has Been Suspended. Please Contact staff");
        //         window.location.href="index.php";
        //         </script>';
        //     }
        // }
        // if(isset($objResult2["driver_work_status"])){
        //     if($objResult2["driver_work_status"]==1){
        //         echo '<script>
        //         var str = new String("Sign In Error");
        //         alert(" This Account Has Been Suspended. Please Contact staff");
        //         window.location.href="index.php";
        //         </script>';
        //     }
        // }
        // if(isset($objResult1["shop_work_status"])){
        //     if($objResult1["shop_work_status"]==1){
        //         echo '<script>
        //         var str = new String("Sign In Error");
        //         alert(" This Account Has Been Suspended. Please Contact staff");
        //         window.location.href="index.php";
        //         </script>';
        //     }
        // }
        if ($count == 1){
            $cus_password = $objResult["cus_password"];
            $_SESSION["loggedin"] = true; 
            $_SESSION["cus_username"] = $cus_username;
            $_SESSION["cus_password"] = $cus_password;
            echo '<script>
            alert( " Welcome \n'. $cus_username .'");
            window.location.href="Home/index.php";
            </script>';
        }
        if ($count1 == 1){
            $_SESSION["loggedin"] = true; 
            $_SESSION["shop_username"] = $cus_username;
            echo '<script>
            alert( " Welcome \n'. $cus_username .'");
            window.location.href="./Shop/Home.php";
            </script>';
        }
        // if ($count2 == 1){
        //     $_SESSION["loggedin"] = true; 
        //     $_SESSION["driver_username"] = $cus_username;
        //     echo '<script>
        //     alert( " Welcome \n'. $cus_username .'");
        //     window.location.href="./website/driver.php";
        //     </script>';
        // }
        else{
            echo '<script>
            var str = new String("Sign In Error");
            alert("Sign In Error\nSorry, your username or password is incorrect\n Please try again");
            window.location.href="index.php";
            </script>';
        }
    }
    else{
        echo "ppppppppppppppppppppp";
    }
?>