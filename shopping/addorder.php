<?php
    session_start();
    require('connect.php');

    $action = isset($_GET['a']) ? $_GET['a'] : "";
    $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    if (isset($_SESSION['qty']))
    {
        $meQty = 0;
        foreach ($_SESSION['qty'] as $meItem)
        {
            $meQty = (int)$meQty + (int)$meItem;
        }
    } else
    {
        $meQty = 0;
    }
    if (isset($_SESSION['cart']) and $itemCount > 0)
    {
        $itemIds = "";
        foreach ($_SESSION['cart'] as $itemId)
        {
            $itemIds = $itemIds . $itemId . ",";
        }
        $inputItems = rtrim($itemIds, ",");
        //echo $inputItems;
        $parts=explode(",",$inputItems);
        $parts=array_filter($parts);
        $inputItems = implode(",",$parts);
        //echo "$inputItems";
        $meSql = "SELECT * FROM food WHERE food_id in ({$inputItems})";
        $meQuery = mysqli_query($meConnect,$meSql);
        $meResult = mysqli_fetch_array($meQuery);
        // $meCount = mysqli_num_rows($meQuery);
    } else
    {
        $meCount = 0;
    }
    $cus_id          = $_SESSION["cus_id"];
    $shop_id         = $_SESSION["shop"];
    $order_price     = $meResult["food_price"] * $meQty;
    $food_id         = $meResult["food_id"];
    $food_price_one  = $meResult["food_price"];

    // $cus_name		 = $_REQUEST['cus_name'];
    // $cus_surname	 = $_REQUEST['cus_surname'];
    // $cus_tel		 = $_REQUEST['cus_tel'];
    // $cus_email	     = $_REQUEST['cus_email'];
    // $address_detail	 = $_REQUEST['address_detail'];
    // print_r($order_price);

    $sql = " INSERT INTO `order` (`cus_id`,`shop_id`,`order_status`,`order_price`,`order_datestartsend`,`order_dateendsend`)
        VALUES ($cus_id, $shop_id, 1, $order_price, NOW(), NOW() )
    ";
    
    $objQuery = mysqli_query($meConnect, $sql);
    $order_id = mysqli_insert_id($meConnect);

    $sql1 = " INSERT INTO `order_details` (`order_id`,`food_id`,`order_details_qty`,`food_price_one`)
        VALUES ($order_id, $food_id, $meQty, $food_price_one) 
    ";
    $objQuery = mysqli_query($meConnect, $sql1);
    
    // print_r($_GET);
    // print_r($_REQUEST);
    
    if ($objQuery) {
	    header("Location: monitor_order.php?order_status=1"); 
        exit;
        // echo "FINISH!!!";
    }else {
	    echo "Error : Input";
    }
?>