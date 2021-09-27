<?php
session_start();
require '../connect.php';
$id_order = $_GET["id"];
$meSql = "SELECT orders.id_orders,orders.Cus_username,orders.orders_total_price,orders.orders_date_start_send,
    orders_detail.id_food,orders_detail.orders_detail_item,food.food_name,food.food_size,food.food_cash,
    food.shop_username,food.FilesName,shop.shop_username,shop.shop_name,shop.shop_address,shop.shop_tel,shop.shop_business_time_day,
    shop.shop_business_time_open_time,shop.shop_business_time_close_time,customer.Cus_address,customer.Cus_tel,customer.Cus_Name
    FROM `orders` JOIN orders_detail
    ON orders.id_orders = orders_detail.id_orders
    JOIN food
    ON orders_detail.id_food = food.id_food
    JOIN shop
    ON food.shop_username = shop.shop_username
    JOIN customer
    ON orders.Cus_username = customer.Cus_username
WHERE orders.id_orders =$id_order";
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
        <title>itoffside.com shopping cart</title>

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
                    while ($meResult = mysqli_fetch_array($meQuery))
                    {
                        ?>
                        <tr>
                            
                            <?php $total_per = $meResult['food_cash']*$meResult['orders_detail_item'];?>
                            <td><img src="../Shop/myfile/<?php echo $meResult['FilesName'];?>" width="120px" height="100px" border="0"></td>
                            
                            <td><?php echo $meResult['food_name']; ?></td>
                            
                            <td>ขนาด <?php echo $meResult['food_size']; ?> สั่งซื้อจำนวน <?php echo $meResult['orders_detail_item'];?> จาน ราคาจานละ <?php echo $meResult['food_cash'];?> บาท</td>
                            <td><?php echo number_format($total_per,2); ?></td>
                        </tr>
                        <?php
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
