<?php 
    session_start();
    require('connect.php');
    $cus_id = $_SESSION["cus_id"];

    $mysql = " SELECT * FROM `customer` JOIN `address` ON customer.cus_id = address.cus_id
    WHERE customer.cus_id = $cus_id
    ";
    $objQuery = mysqli_query($meConnect,$mysql);
    $objResult = mysqli_fetch_array($objQuery);
    // print_r($cus_username);
    $id_shop = $_GET["shop"];
    
    $mysql1 = " SELECT * FROM order 
    JOIN order_details ON order.order_id = order_details.order_id
    JOIN food ON order_details.food_id = food.food_id
    JOIN shop ON order.shop_id = shop.shop_id 
    ";
    $objQuery1 = mysqli_query($meConnect,$mysql1);
    // $objResult1 = mysqli_fetch_array($objQuery1);

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
        $meCount = mysqli_num_rows($meQuery);
    } else
    {
        $meCount = 0;
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>checkout</title>
        <!--css-->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
        <link href="bootstrap/css/checkout.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="title">
                <h2>ยืนยันคำสั่งซื้อ</h2>
            </div>
            <div class="d-flex">
                <form action="addorder.php?shop=<?php echo $id_shop;?>" method="post">
                    <label>
                    <span class="fname">ชื่อ <span class="required">*</span></span>
                    <input type="text" name="cus_name" value="<?=$objResult["cus_name"]?>" disabled>
                    </label>
                    <label>
                    <span class="lname">นามสกุล <span class="required">*</span></span>
                    <input type="text" name="cus_surname" value="<?=$objResult["cus_surname"]?>" disabled>
                    </label>
                    <label>
                    <span>ที่อยู่ <span class="required">*</span></span>
                    <input type="text" name="address_detail" rows="10" cols="60" value="<?=$objResult["address_detail"]?>" disabled></input>
                    </label>
                    <label>
                    <span>อีเมล</span>
                    <input type="text" name="cus_email" rows="10" cols="60" value="<?=$objResult["cus_email"]?>" disabled></input>
                    </label>
                    <label>
                    <span>เบอร์โทรศัพท์ <span class="required">*</span></span>
                    <input type="tel" name="cus_tel" value="<?=$objResult["cus_tel"]?>" disabled> 
                    </label>
                
                
                <div class="Yorder" >
                    <table>
                    <tr>
                        <th colspan="2" >รายละเอียด</th>
                    </tr>
                   
                    <?php while ($meResult = mysqli_fetch_array($meQuery)):?>
                        <?php
                        $total_price = 0;
                        $num = 0;
                        $key = array_search($meResult['food_id'], $_SESSION['cart']);
                        $total_price = $total_price + ($meResult['food_price'] * $_SESSION['qty'][$key]);  
                        ?>
                    <tr>
                        <td><?php echo $meResult['food_name']; ?></td>
                        <td><?php echo $meResult['food_price']; ?> บาท</td>
                    </tr>
                    <tr>
                        <td>รวม</td>
                        <td><?php echo number_format($total_price);?> บาท</td>
                    </tr>
                    <?php endwhile;?>
                    </table><br>
                    <!--<div>
                    <input type="radio" name="dbt" value="dbt" checked> ชำระผ่าน Moblie Banking
                    </div>-->
                    <div>
                    <input type="radio" name="dbt" value="cd" checked> ชำระเงินปลายทาง
                    </div>
                    <button class="button" type="submit">สั่งซื้อ</button>
                </div>
                </form><!-- Yorder -->
            </div>
        </div> <!-- /container -->
    </body>
</html>