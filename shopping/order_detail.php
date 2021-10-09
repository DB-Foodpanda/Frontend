<?php
session_start();
require 'connect.php';
$id_order = $_GET["id"];
$meSql = "SELECT food.id_food,food.food_size,food.FilesName,food.food_name,food.food_cash,orders_detail.id_orders_detail,orders_detail.orders_detail_item ,food.shop_username,orders_detail.orders_detail_item,orders_detail.id_orders FROM orders_detail
INNER JOIN food ON orders_detail.id_food = food.id_food
WHERE id_orders =$id_order";
$meQuery = mysqli_query($meConnect,$meSql);
$meResult = mysqli_fetch_array($meQuery);


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
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/nava.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="container">

            <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href=<?php echo "monitor_order.php"?>>กลับสู่หน้าติดตามออเดอร์</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>

            <!-- Main component for a primary marketing message or call to action -->
            
            <h3>หน้าแรกของสินค้า</h3>
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
mysqli_close($meConnect);
