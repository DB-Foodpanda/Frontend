<?php
session_start();
require 'connect.php';
$order_status_id = $_GET["order_status"];
$cus_username = $_SESSION["cus_username"];
$cus_id = $_SESSION["cus_id"];

$meSql = "SELECT * FROM `order` 
JOIN order_details ON order.order_id = order_details.order_id
JOIN food ON order_details.food_id = food.food_id 
JOIN customer ON order.cus_id = customer.cus_id
JOIN shop ON order.shop_id = shop.shop_id 
LEFT JOIN driver ON order.driver_id = driver.driver_id
WHERE order.cus_id =  $cus_id AND order.order_status = $order_status_id
GROUP BY order.order_id
";

$meSql1 = "SELECT * FROM `order` 
JOIN order_details ON order.order_id = order_details.order_id
JOIN food ON order_details.food_id = food.food_id 
JOIN customer ON order.cus_id = customer.cus_id
JOIN shop ON order.shop_id = shop.shop_id 
LEFT JOIN driver ON order.driver_id = driver.driver_id
WHERE order.cus_id = $cus_id AND order.order_status = $order_status_id
GROUP BY order.order_id
";

if(isset($_GET["order_status"])){
    $name = $_GET['order_status'];
}
$meQuery = mysqli_query($meConnect,$meSql);
$meQuery1 = mysqli_query($meConnect,$meSql1);
$action = isset($_GET['a']) ? $_GET['a'] : "";
// $meResult = mysqli_fetch_array($meQuery);
// print_r($meQuery);

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
        <title>สถานะคำสั่งซื้อ</title>

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
                            $wait_send="";
                            $pending_confirm="";
                            $send="";
                            $cancel="";
                            if(isset($_GET["order_status"])){
                                if($_GET["order_status"]==1){
                                    $wait = "active";
                                }
                                else if($_GET["order_status"]==2){
                                    $wait_send = "active";
                                }
                                else if($_GET["order_status"]==3){
                                    $pending_confirm = "active";
                                }
                                else if($_GET["order_status"]==4){
                                    $send = "active";
                                }
                                else if($_GET["order_status"]==5){
                                    $cancel = "active";
                                }
                            }
                            else{
                                $wait = "active";
                            }
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="<?=$wait?>"><a href="./monitor_order.php?order_status=1">รอคนขับรับงาน</a></li>
                            <li class="<?=$wait_send?>"><a href="./monitor_order.php?order_status=2">กำลังนำส่ง </a></li>
                            <li class="<?=$pending_confirm?>"><a href="./monitor_order.php?order_status=3">รอยืนยัน </a></li>
                            <li class="<?=$send?>"><a href="./monitor_order.php?order_status=4">จัดส่งเรียบร้อย </a></li>
                            <li class="<?=$cancel?>"><a href="./monitor_order.php?order_status=5">งานที่ถูกยกเลิก</a></li>
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
                            if(isset($_GET["order_status"])){
                                $order_status = $_GET["order_status"];
                            if($_GET["order_status"]==3 || $_GET["order_status"]== 4 ){
                                echo"<th>วันที่ส่ง</th>
                                <th>เวลาที่ส่ง</th>";
                            }
                            else if(strcmp("$order_status","5")==0){
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
                    
                    while ($meResult = mysqli_fetch_array($meQuery))
                    {
                        $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                        $splitTimeStamp = explode(" ",$meResult["order_datestartsend"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        $splitTimeStamp1 = explode(" ",$meResult["order_dateendsend"]);
                        $date_a1 = $splitTimeStamp1[0];
                        $time_a1 = $splitTimeStamp1[1];
                        $date1 = explode("-",$date_a1);
                        echo'<tr>
                            <td>'.$meResult['order_id'].'</td>
                            <td>'.intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543).'</td>';
                            if($_GET["order_status"]==3||$_GET["order_status"]==4||strcmp("$order_status","5")==0){
                                echo'<td>'.$time_a.'</td>
                                <td>'.intval($date1[2])." ".$monthNamesThai[$date[1]-1]." ".($date1[0]+543).'</td>
                                <td>'.$time_a1.'</td>';
                            }
                            echo'<td>'.$meResult['order_price'].'</td>
                            <td>'.$meResult['driver_username'].'</td>
                            <td>'.$meResult['order_status'].'</td>
                            <td>
                                            <a class="btn btn-primary btn-lg" href="order_detail.php?id='.$meResult["order_id"].'" role="button">
                                            ดูรายละเอียด</a>
                                        </td>';
                                if($_GET["order_status"]==1||$_GET["order_status"]==2){
                                    echo '<td>
                                            <a class="btn btn-danger btn-lg" href="cancel.php?id='.$meResult["order_id"].'" role="button">
                                            ยกเลิก</a>
                                        </td>';
                                }
                                else if($_GET["order_status"]==3){
                                    echo '<td>
                                            <a class="btn btn-success btn-lg" href="confirm.php?id='.$meResult["order_id"].'&shop='.$meResult["shop_username"].'
                                            &d='.$meResult["driver_username"].'
                                            &tt='.$meResult["order_price"].'&de='.$meResult["driver_earnprice"].'&se='.$meResult["shop_earnprice"].'" role="button">
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
                    while ($meResult = mysqli_fetch_array($meQuery1))
                    {
                        $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                        $splitTimeStamp = explode(" ",$meResult["order_datestartsend"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        $splitTimeStamp1 = explode(" ",$meResult["order_dateendsend"]);
                        $date_a1 = $splitTimeStamp1[0];
                        $time_a1 = $splitTimeStamp1[1];
                        $date1 = explode("-",$date_a1);
                        echo'<tr>
                            <td>'.$meResult['order_id'].'</td>
                            <td>'.intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543).'</td>';
                            echo'<td>'.$time_a.'</td>';
                            echo'<td>'.$meResult['order_price'].'</td>
                            <td>'.$meResult['order_status'].'</td>
                            <td>
                                            <a class="btn btn-primary btn-lg" href="order_detail.php?id='.$meResult["order_id"].'" role="button">
                                            ดูรายละเอียด</a>
                                        </td>';
                                    echo '<td>
                                            <a class="btn btn-danger btn-lg" href="cancel.php?id='.$meResult["order_id"].'" role="button">
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
