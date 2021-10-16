<?php
session_start();
require '../connect.php';
$order_id = $_GET["id"];

    $meSql = "SELECT * FROM `order` 
    JOIN order_details ON order.order_id = order_details.order_id
    JOIN food ON order_details.food_id = food.food_id 
    JOIN customer ON order.cus_id = customer.cus_id
    JOIN shop ON order.shop_id = shop.shop_id
    JOIN address ON address.cus_id = customer.cus_id
    WHERE order.order_id =$order_id";
    $meQuery = mysqli_query($conn,$meSql);


$action = isset($_GET['a']) ? $_GET['a'] : "";


$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        
        $meQty = (int)$meQty + (int)$meItem;
        $_SESSION['meQty']=$meQty; 
    }
}else{
    $meQty=0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายละเอียดออเดอร์</title>

        <!-- Bootstrap -->
        <link href="../shopping/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../shopping/bootstrap/css/nava.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="container">


            
<?php
if($action == 'exists'){
    echo "<div class=\"alert alert-warning\">เพิ่มจำนวนสินค้าแล้ว</div>";
}
if($action == 'add'){
    echo "<div class=\"alert alert-success\">เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
}
if($action == 'order'){
	echo "<div class=\"alert alert-success\">สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
}
if($action == 'orderfail'){
	echo "<div class=\"alert alert-warning\">สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
}
if($action == 'finishOrder'){
	echo "<div class=\"alert alert-warning\">ยืนยันคำสั่งซื้อของร้านนี้ก่อน จึงสามารถสั่งซื้ออาหารของร้านอื่นได้</div>";
}
?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>ราคารวมต่อเมนู<th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    while ($meResult = mysqli_fetch_array($meQuery))
                    {
                        ?>
                        <tr>
                            
                            <?php $total_per = $meResult['food_price']*$meResult['order_details_qty'];?>
                            <td><img src="../Shop/myfile/<?php echo $meResult['food_image'];?>" width="120px" height="120px" border="0"></td>
                            
                            <td><?php echo $meResult['food_name']; ?></td>
                            
                            <td>ขนาด <?php echo $meResult['food_size']; ?> สั่งซื้อจำนวน <?php echo $meResult['order_details_qty'];?> จาน ราคาจานละ <?php echo $meResult['food_price'];?> บาท</td>
                            <td><?php echo number_format($total_per,2); ?></td>
                        </tr>
                        <?php
                        if($count==0){
                            echo '<h4 style="text-align: right;">'.$meResult["cus_name"].'<br>ที่อยู่ลูกค้า : '.$meResult["address_detail"].'<br>เบอร์โทร : '.$meResult["cus_tel"].'</h4>';
                        echo '<b>'.$meResult["shop_name"].'</b><br>ที่อยู่ร้านค้า: '.$meResult["shop_address"].'<br> วันที่เปิด: '.$meResult["shop_openday"].'<br> เวลาเปิด-ปิด: '.$meResult["shop_opentime"].' - '.$meResult["shop_closetime"];
                        }
                        $count++;
                    }
                    ?>
                        
                </tbody>
            </table>
            


        </div> <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysqli_close($conn);
