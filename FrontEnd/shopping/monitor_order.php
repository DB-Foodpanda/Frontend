<?php
session_start();
require 'connect.php';
$cus_username = $_SESSION["cus_username"];
$meSql = "SELECT *
FROM orders JOIN orders_status
ON orders.id_orders_status = orders_status.id_orders_status
JOIN orders_detail
ON orders.id_orders = orders_detail.id_orders
JOIN food
ON orders_detail.id_food = food.id_food
JOIN shop
ON food.shop_username = shop.shop_username
JOIN driver
ON orders.driver_username = driver.driver_username
JOIN driver_status
ON driver.ID_driver_status = driver_status.ID_driver_status
WHERE orders.Cus_username =  '$cus_username' AND orders.id_orders_status IN
";
$meSql1 = "SELECT *
FROM orders JOIN orders_status
ON orders.id_orders_status = orders_status.id_orders_status
JOIN orders_detail
ON orders.id_orders = orders_detail.id_orders
JOIN food
ON orders_detail.id_food = food.id_food
JOIN shop
ON food.shop_username = shop.shop_username
WHERE orders.Cus_username =  '$cus_username' AND orders.id_orders_status IN
";
if(isset($_GET["id_orders_status"])){
    $name = $_GET['id_orders_status'];
    $meSql .= "(".$name.")";
    $meSql1 .= "(".$name.")";
}
else{
    $meSql .='("1")';
    $meSql1 .='("1")';
}
$meSql.="GROUP BY orders.id_orders";
$meSql1.="GROUP BY orders.id_orders";
$meQuery = mysqli_query($meConnect,$meSql);
$meQuery1 = mysqli_query($meConnect,$meSql1);
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
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../Home/index.php" >Home</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <?php
                            $wait="";
                            $wait_buy="";
                            $wait_send="";
                            $send="";
                            $cancel="";
                            if(isset($_GET["id_orders_status"])){
                                if($_GET["id_orders_status"]==1){
                                    $wait = "active";
                                }
                                else if($_GET["id_orders_status"]==2){
                                    $wait_buy = "active";
                                }
                                else if($_GET["id_orders_status"]==3){
                                    $wait_send = "active";
                                }
                                else if($_GET["id_orders_status"]==4){
                                    $send = "active";
                                }
                                else{
                                    $cancel = "active";
                                }
                            }
                            else{
                                $wait = "active";
                            }
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="<?=$wait?>"><a href="./monitor_order.php?id_orders_status=1">รอคนขับรับงาน</a></li>
                            <li class="<?=$wait_buy?>"><a href="./monitor_order.php?id_orders_status=2">คนขับรับงานแล้ว</a></li>
                            <li class="<?=$wait_send?>"><a href="./monitor_order.php?id_orders_status=3">กำลังนำส่ง </a></li>
                            <li class="<?=$send?>"><a href="./monitor_order.php?id_orders_status=4">จัดส่งเรียบร้อย </a></li>
                            <li class="<?=$cancel?>"><a href="./monitor_order.php?id_orders_status=88,99">งานที่ถูกยกเลิก</a></li>
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
            <?php
                if(!(strcmp("$wait","active")==0)){
                    echo'<table class="table table-striped">
                <thead>
                    <tr>
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>วันที่ซื้อ</th>
                        <th>เวลาที่ซื้อ</th>';
                            if(isset($_GET["id_orders_status"])){
                                $id_orders_status = $_GET["id_orders_status"];
                            if($_GET["id_orders_status"]==4){
                                echo"<th>วันที่ส่ง</th>
                                <th>เวลาที่ส่ง</th>";
                            }
                            else if(strcmp("$id_orders_status","88,99")==0){
                                echo"<th>วันที่ยกเลิก</th>
                                <th>เวลาที่ยกเลิก</th>";
                            }
                            }
                        echo'<th>ราคา</th>
                        <th>driver</th>
                        <th>สถานะ</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>';
                    $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                    while ($meResult = mysqli_fetch_array($meQuery))
                    {
                        $splitTimeStamp = explode(" ",$meResult["orders_date_start_send"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        $splitTimeStamp1 = explode(" ",$meResult["orders_date_end_send"]);
                        $date_a1 = $splitTimeStamp1[0];
                        $time_a1 = $splitTimeStamp1[1];
                        $date1 = explode("-",$date_a1);
                        echo'<tr>
                            <td>'.$meResult['id_orders'].'</td>
                            <td>'.intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543).'</td>';
                            if($_GET["id_orders_status"]==4||strcmp("$id_orders_status","88,99")==0){
                                echo'<td>'.$time_a.'</td>
                                <td>'.intval($date1[2])." ".$monthNamesThai[$date[1]-1]." ".($date1[0]+543).'</td>
                                <td>'.$time_a1.'</td>';
                            }
                            echo'<td>'.$meResult['orders_total_price'].'</td>
                            <td>'.$meResult['driver_username'].'</td>
                            <td>'.$meResult['orders_status_name'].'</td>
                            <td>
                                            <a class="btn btn-primary btn-lg" href="order_detail.php?id='.$meResult["id_orders"].'" role="button">
                                            ดูรายละเอียด</a>
                                        </td>';
                                if($_GET["id_orders_status"]==1||$_GET["id_orders_status"]==2){
                                    echo '<td>
                                            <a class="btn btn-danger btn-lg" href="cancel.php?id='.$meResult["id_orders"].'" role="button">
                                            ยกเลิก</a>
                                        </td>';
                                }
                                else if($_GET["id_orders_status"]==3){
                                    echo '<td>
                                            <a class="btn btn-success btn-lg" href="confirm.php?id='.$meResult["id_orders"].'&shop='.$meResult["shop_username"].'
                                            &d='.$meResult["driver_username"].'&d_r='.$meResult["driver_status_rate"].'&s_s='.$meResult["shop_share"].'
                                            &tt='.$meResult["orders_total_price"].'&de='.$meResult["driver_earn_price"].'&se='.$meResult["shop_earn_price"].'" role="button">
                                            ได้รับของและตรวจสอบแล้ว</a>
                                        </td>';
                                }
                        echo'</tr>';
                    }
                echo'</tbody>
            </table>';
                }
                else{
                    echo'<table class="table table-striped">
                <thead>
                    <tr>
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>วันที่ซื้อ</th>
                        <th>เวลาที่ซื้อ</th>';
                        echo'<th>ราคา</th>
                        <th>สถานะ</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>';
                    $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                    while ($meResult = mysqli_fetch_array($meQuery1))
                    {
                        $splitTimeStamp = explode(" ",$meResult["orders_date_start_send"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        $splitTimeStamp1 = explode(" ",$meResult["orders_date_end_send"]);
                        $date_a1 = $splitTimeStamp1[0];
                        $time_a1 = $splitTimeStamp1[1];
                        $date1 = explode("-",$date_a1);
                        echo'<tr>
                            <td>'.$meResult['id_orders'].'</td>
                            <td>'.intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543).'</td>';
                            echo'<td>'.$time_a.'</td>';
                            echo'<td>'.$meResult['orders_total_price'].'</td>
                            <td>'.$meResult['orders_status_name'].'</td>
                            <td>
                                            <a class="btn btn-primary btn-lg" href="order_detail.php?id='.$meResult["id_orders"].'" role="button">
                                            ดูรายละเอียด</a>
                                        </td>';
                                    echo '<td>
                                            <a class="btn btn-danger btn-lg" href="cancel.php?id='.$meResult["id_orders"].'" role="button">
                                            ยกเลิก</a>
                                        </td>';
                        echo'</tr>';
                    }
                echo'</tbody>
            </table>';
                }
            ?>


        </div> <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysqli_close($meConnect);
