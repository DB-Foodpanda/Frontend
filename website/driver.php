<?php
session_start();
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Grab_present/index.php");
    exit;
}*/
require('../connect.php');
if(empty($_SESSION["driver_username"])){
    header("location:../index.php");
}
$driver_id = $_SESSION["driver_id"];
$driver_username = $_SESSION["driver_username"];
$state = $_GET["state"];

  $sql = " SELECT * FROM `driver` WHERE driver_username = '$driver_username' ;
    ";
    
    $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
    $objResult = mysqli_fetch_array($objQuery);
  
    $meSql = "SELECT * FROM `order` 
    JOIN order_details ON order.order_id = order_details.order_id
    JOIN food ON order_details.food_id = food.food_id 
    JOIN customer ON order.cus_id = customer.cus_id
    JOIN shop ON order.shop_id = shop.shop_id 
    WHERE order.order_status = $state
    ";
    $objQuery1 = mysqli_query($conn, $meSql);

    // print_r($_SESSION);
    $head1 = "";
    $head2 = "";
    $head3 = "";
    $head4 = "";
    if(isset($_GET["state"])){
        if(strcmp("$state","4")==0){
            $meSql.="(4)";
            $head4 = "active";
        }
        else if(strcmp("$state","3")==0){
            $meSql.="(3)";
            $head3 = "active";
        }
        else if(strcmp("$state","2")==0){
            $meSql.="(2)";
            $head2 = "active";
        }
        else if(strcmp("$state","1")==0){
            $meSql.="(1)";
            $head1 = "active";
        }
    }
    else{
        $meSql.="(1)";
        $head1 = "active";
    }
    // $meSql.="GROUP BY orders.id_orders";
?>
<?php
$show="";
$pass=True;
if(!isset($_GET["show"])){
    $show= "disabled";
    $pass= false;
}
?>

<head>
  <title>Driver</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../Shop/css/home.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row font1">
  		<div class="col-sm-10"><h1>ข้อมูลคนขับ</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class=" img-responsive" src="https://www.khaosod.co.th/wpapp/uploads/2020/10/foodpanda-logo-696x448.png"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3">
        <div class="panel panel-default font1">
            <div class="panel-heading">ข้อมูลของคนขับ <i class="fa fa-link fa-1x"></i></div>
            <!-- <div class="panel-body"> <p> คะแนนลูกค้ท </p> </div> -->
            <form action="check_pass.php" method="post">
            <div class="panel-body form-group">
<div class="col-xs">
<?php $driver_name = $objResult["driver_name"];?>
    <label for="driver_username"><p>ชื่อผู้ใช้</p></label>
    <input type="text" class="form-control" name="driver_username" disabled id="driver_username" placeholder="ชื่อผู้ใช้" value="<?=$objResult["driver_username"]?>">
</div>

<div class="col-xs">
  <label for="driver_password"><p> รหัสผ่าน</p></label>
    <input type="password" class="form-control" name="driver_password" id="driver_password" placeholder="รหัสผ่าน"
    <?php
        if($pass){
            echo 'value="'.$objResult["driver_password"].'" disabled';
        }
    ?>><br>
</div>
<div class="col-xs">
    <input type="submit" class="btn btn-lg button-pink" name="submit" value="แก้ไขข้อมูล" id="driver_password" placeholder="รหัสผ่าน">
</div>
</div>
        </form>
          </div>
          <div class="panel panel-default font1">
            <div class="panel-heading">ข้อมูล<i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body form-group">
                <div class="col-xs">
                  <label for="driver_earnprice"><p> รายได้รวม</p></label>
                    <input type="text" disabled class="form-control" name="driver_earnprice" id="driver_earnprice" 
                    placeholder="รายได้รวม" value="<?php echo $objResult["driver_earnprice"];?>">
                </div>
            </div>

          </div>
          <div class="logout">
            <a href="../website/logout.php" class="btn btn-lg button-pink">ออกจากระบบ</a>
          </div>


        </div><!--/col-3-->
    	<div class="col-sm-9 font1">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" href="#home">หน้าข้อมูลคนขับ</a></li>
                <li class="active"><a data-toggle="tab" href="#messages">ออเดอร์</a></li>
              </ul>


            <div class="tab-content font1">
            <div class="tab-pane" id="home">
                <hr>
                  <form class="form" action="driver_edit.php" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="driver_name"><h4>ชื่อ และ นามสกุล</h4></label>
                              <input type="text" class="form-control" 
                              <?php echo $show;?>  name="driver_name" id="driver_name" 
                              placeholder="ชื่อ และ นามสกุล" title="กรุณากรอกชื่อและนามสกุล" value="<?=$driver_name?>" Required>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="driver_tel"><h4>เบอร์มือถือ</h4></label>
                              <input type="text" class="form-control" 
                              <?php echo $show;?> name="driver_tel" id="driver_tel" 
                              placeholder="ใส่เบอร์มือถือ" title="กรุณากรอกเบอร์มือถือ" value="<?=$objResult["driver_tel"];?>" Required>
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="driver_earnacc_no"><h4>หมายเลขบัญชี</h4></label>
                              <input type="text" class="form-control" 
                              <?php echo $show;?> name="driver_earnacc_no" 
                              id="driver_earnacc_no" placeholder="ใส่หมายเลขบัญชี" title="กรุณาใส่หมายเลขบัญชี" 
                              value="<?=$objResult["driver_earnacc_no"];?>" Required>
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="driver_work_name"><h4>สถานะของคนขับ</h4></label><br>
                                <select name="driver_workstatus" <?php echo $show;?>> 
                                    <?php 
                                        $options = $objResult["driver_workstatus"];
                                    ?>
                                    <option value="1" <?php if($options== 1) echo 'selected="selected"'; ?> >Working</option>
                                    <option value="2" <?php if($options== 2) echo 'selected="selected"'; ?> >Not Working</option>
                                </select>
                            </div>
                      </div>
                      
                    <div class="form-group">

                    <div class="col-xs-3">
                        <label for="driver_password"><h4>รหัสผ่านใหม่</h4></label>
                        <input type="text" class="form-control" <?php echo $show;?> 
                        name="driver_password" id="driver_password" placeholder="รหัสผ่านใหม่" 
                        title="รหัสผ่านใหม่" value="">
                    </div>
                    </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg button-pink" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> ลบทั้งหมด</button>
                            </div>
                      </div>
              	</form>

              <hr>

             </div><!--/tab-pane-->
             <div class="tab-pane active" id="messages">
                <div style="text-align: right;">
                <ul class="nav nav-tabs">
                    <li class="<?=$head1?>"><a href="driver.php?state=1">งานใหม่</a></li>
                    <li class="<?=$head2?>"><a href="driver.php?state=2">งานที่รับมา</a></li>                
                    <li class="<?=$head3?>"><a href="driver.php?state=3">ประวัติ</a>
                    <li class="<?=$head4?>"><a href="driver.php?state=4">งานที่ยกเลิก</a>
                </ul>
                </div>
             <table class="table table-striped">
                <thead>
                    <tr>
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>ลูกค้า</th>
                        <th>ร้าน</th>
                        <th>วันที่ซื้อ</th>
                        <th>เวลาที่ซื้อ</th>
                        <th>ราคา</th>
                        <th>สถานะคำสั่งซื้อ</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($meResult = mysqli_fetch_array($objQuery1)):?>
                       <?php
                        
                        $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                        $splitTimeStamp = explode(" ",$meResult["order_datestartsend"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a); 
                        // print_r($objQuery1);
                         ?>
                        
                        <tr>
                            <td><?php echo $meResult['order_id']; ?></td>
                            <td><?php echo $meResult['cus_username']; ?></td>
                            <td><?php echo $meResult['shop_name']; ?></td>
                            <td><?php echo intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543); ?></td>
                            <td><?php echo $time_a; ?></td>
                            <td><?php echo $meResult['order_price']; ?></td>
                            <td><?php echo $meResult["order_status"]; ?></td>
                        </tr>
                        <tr>
                        
                        <td>
                            <a class="btn btn-primary btn-lg" href="order_detail_driver.php?id=<?php echo $meResult["order_id"];?>" role="button" target="_blank">
                                ดูรายละเอียด</a>
                        </td>
                               
                            <?php
                                
                                if(strcmp("$head1","active")==0){
                                    echo '<td colspan="8" style="text-align: right;">
                                    <a class="btn btn-success btn-lg" href="accept.php?id='.$meResult["order_id"].'" role="button">
                                    รับงาน</a>
                                    </td>';
                                }
                                else if(strcmp("$head2","active")==0){
                                    echo'<td colspan="8" style="text-align: right;">
                                    <a class="btn btn-danger btn-lg" href="cancel_driver.php?id='.$meResult["order_id"].'" role="button" target="_blank">
                                    ยกเลิก</a>
                                    </td>';
                                    echo '<td colspan="8" style="text-align: right;">
                                    <a class="btn btn-success btn-lg" href="sending.php?id='.$meResult["order_id"].'" role="button">
                                    รับอาหารแล้ว</a>
                                    </td>';
                                }
                            ?>
                        </tr>
                        <?php endwhile;?>
                </tbody>
            </table>
             </div>

              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>