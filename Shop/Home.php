<?php
session_start();
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Grab_present/index.php");
    exit;
}*/
require('../connect.php');
if(empty($_SESSION["shop_username"])){
    header("location:../index.php");
}

$shop_username = $_SESSION["shop_username"]; 
  $sql = "
  SELECT * 
FROM `shop` 
 WHERE shop_username = '$shop_username' ;
    ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);

  $sql2 = "
  SELECT * 
FROM `shop` JOIN food
ON shop.shop_username = food.shop_username
 WHERE shop.shop_username = '$shop_username' ;
    ";

  $objQuery2 = mysqli_query($conn, $sql2) or die("Error Query [" . $sql . "]");

  
    $meSql = "SELECT orders.id_orders,orders.id_orders_status,orders.Cus_username,orders.orders_total_price,orders.orders_date_start_send,
    orders_detail.id_food,orders_detail.orders_detail_item,food.food_name,food.food_size,food.food_cash,
food.shop_username,shop.shop_username,shop.shop_name,shop.shop_address,shop.shop_tel,shop.shop_business_time_day,shop.shop_business_time_open_time,shop.shop_business_time_close_time,customer.Cus_address,customer.Cus_tel,orders_status.orders_status_name
    FROM `orders` JOIN orders_detail
    ON orders.id_orders = orders_detail.id_orders
    JOIN food
    ON orders_detail.id_food = food.id_food
    JOIN shop
    ON food.shop_username = shop.shop_username
    JOIN customer
    ON orders.Cus_username = customer.Cus_username
   JOIN orders_status
   ON orders.id_orders_status = orders_status.id_orders_status
   WHERE shop.shop_username='$shop_username' AND orders.id_orders_status=2
    ";
    $head1 = "";
    $head2 = "";
    $head3 = "";
    $p1 = "";
    $p2 = "";
    $p2_edit = "";
    if(isset($_GET["state"])){
        $state = $_GET["state"];
        $p2="active";
        if(strcmp("$state","2")==0){
            $head2 = "active";
        }
        else if(strcmp("$state","1")==0){
            $head1 = "active";
        }
        else if(strcmp("$state","3")==0){
            $head2 = "active";
            $p2_edit = "active";
        }
    }
    else{
        $p1 = "active";
        $head1 = "active";
    }
    $meSql.="GROUP BY orders.id_orders";
    $objQuery1 = mysqli_query($conn, $meSql);
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
  <title>กรอกข้อมูลร้านค้า</title>
  <meta charset="utf-8">
  <style type = "text/css">
    @font-face {
      font-family: title;
      src :url('fonts/Prompt-Light.ttf');
    }
    .font1 {
      font-family: title;
      font-size: 15px;
    }
    </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row font1">
  		<div class="col-sm-10"><h1>ข้อมูลร้านค้า</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="https://www.grab.com/th/wp-content/uploads/sites/10/2018/04/Grab-logo-social.png"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->


      <!--<div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <input type="file" class="text-center center-block file-upload">
      </div></hr><br>-->


        <div class="panel panel-default font1">
            <div class="panel-heading">ข้อมูลของร้านค้า <i class="fa fa-link fa-1x"></i></div>
            <!-- <div class="panel-body"> <p> คะแนนลูกค้ท </p> </div> -->
            <form action="check_pass_shop.php" method="post">
            <div class="panel-body form-group">
            <div class="col-xs" style="text-align: center;">
                <img src="myfile/<?php echo $objResult['FilesName'];?>" width="120px" height="100px" border="0"><br>
            </div>
<div class="col-xs">
<?php $shop_name = $objResult["shop_name"];?>
    <label for="shop_username"><p>ชื่อผู้ใช้</p></label>
    <input type="text" class="form-control" name="shop_username" disabled id="shop_username" placeholder="ชื่อผู้ใช้" value="<?=$objResult["shop_username"]?>">
</div>

<div class="col-xs">
  <label for="shop_password"><p> รหัสผ่าน</p></label>
    <input type="password" class="form-control" name="shop_password" id="shop_password" placeholder="รหัสผ่าน"
    <?php
        if($pass){
            echo 'value="'.$objResult["shop_password"].'" disabled';
        }
    ?>><br>
</div>
<div class="col-xs">
    <input type="submit" class="btn btn-lg btn-success" name="submit" value="แก้ไขข้อมูล" id="shop_password" placeholder="รหัสผ่าน">
</div>
</div>
            </form>


          </div>
          <div class="panel panel-default font1">
            <div class="panel-heading">ข้อมูล<i class="fa fa-link fa-1x"></i></div>
            <!-- <div class="panel-body"> <p> คะแนนลูกค้ท </p> </div> -->
            <div class="panel-body form-group">
                <div class="col-xs">
                  <label for="shop_earn_price"><p> รายได้รวม</p></label>
                    <input type="text" disabled class="form-control" name="shop_earn_price" id="shop_earn_price" placeholder="รายได้รวม" value="<?php echo $objResult["shop_earn_price"];?>">
                </div>
            </div>

          </div>
          <a href="../website/logout.php">ออกจากระบบ</a>

        <!--  <ul class="list-group font1 ">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> -->

        <!--  <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x font1"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div> -->

        </div><!--/col-3-->
    	<div class="col-sm-9 font1">
            <ul class="nav nav-tabs">
                <li class=""><a data-toggle="tab" href="#home">หน้าข้อมูลร้านค้า</a></li>
                <li class="<?=$p1?>"><a data-toggle="tab" href="#messages">ออเดอร์</a></li>
                <li class="<?=$p2?>"><a data-toggle="tab" href="#menu">เมนู</a></li>
              </ul>


            <div class="tab-content font1">
            <div class="tab-pane " id="home">
                <hr>
                  <form class="form" action="shop_edit.php" method="post" id="registrationForm" enctype="multipart/form-data">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="shop_name"><h4>ชื่อ และ นามสกุล</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?>  name="shop_name" id="shop_name" placeholder="ชื่อ และ นามสกุล" title="กรุณากรอกชื่อและนามสกุล" value="<?=$shop_name?>">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="shop_tel"><h4>เบอร์มือถือ</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_tel" id="shop_tel" placeholder="ใส่เบอร์มือถือ" title="กรุณากรอกเบอร์มือถือ" value="<?=$objResult["shop_tel"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="shop_earn_acc_no"><h4>หมายเลขบัญชี</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_earn_acc_no" id="shop_earn_acc_no" placeholder="ใส่หมายเลขบัญชี" title="กรุณาใส่หมายเลขบัญชี" value="<?=$objResult["shop_earn_acc_no"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="shop_address"><h4>ที่อยู่</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_address" id="shop_address" placeholder="ใส่ที่อยู่" title="กรุณาใส่ที่อยู่" value="<?=$objResult["shop_address"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="shop_business_time_day"><h4>วันที่เปิด</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_business_time_day" id="shop_business_time_day" placeholder="วันที่เปิด" title="กรุณาใส่วันที่เปิด" value="<?=$objResult["shop_business_time_day"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_business_time_open_time"><h4>เวลาเปิดเริ่ม</h4></label>
                              <input type="time" class="form-control" Required <?php echo $show;?> name="shop_business_time_open_time" id="shop_business_time_open_time" placeholder="เวลาเปิดเริ่ม" title="เวลาเปิดเริ่ม" value="<?=$objResult["shop_business_time_open_time"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_business_time_close_time"><h4>ถึง</h4></label>
                              <input type="time" class="form-control" Required <?php echo $show;?> name="shop_business_time_close_time" id="shop_business_time_close_time" placeholder="เวลาเปิดถึง" title="เวลาเปิดถึง" value="<?=$objResult["shop_business_time_close_time"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_work_rate"><h4>ส่วนแบ่ง</h4></label>
                              <input type="text" class="form-control" disabled name="shop_work_rate" id="shop_work_rate" placeholder="ส่วนแบ่ง" title="สถานะคนขับ" value="<?=$objResult["shop_share"];?>">
                          </div>
                      </div>
                      <div class="form-group">
                            <div class="col-xs-3">
                                <label for="shop_new_password"><h4>รหัสผ่านใหม่</h4></label>
                                <input type="text" class="form-control" <?php echo $show;?> name="shop_new_password" id="shop_new_password" placeholder="iหัสผ่านใหม่" title="รหัสผ่านใหม่" value="">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                        <input type="hidden" name="hdnOldFile" value="<?php echo $objResult["FilesName"];?>">
                            <label for="filUpload"><h4>รูปภาพ</h4></label>
                            <input type="file" name="filUpload" class="form-control" <?php echo $show;?>>
                        </div>
                    </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> ลบทั้งหมด</button>
                            </div>
                      </div>
              	</form>

              <hr>

             </div><!--/tab-pane-->
             <div class='tab-pane <?=$p1?>' id="messages">
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
                    $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                    while ($meResult = mysqli_fetch_array($objQuery1))
                    {
                        $splitTimeStamp = explode(" ",$meResult["orders_date_start_send"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        ?>
                        <tr>
                            <td><?php echo $meResult['id_orders']; ?></td>
                            <td><?php echo $meResult['Cus_username']; ?></td>
                            <td><?php echo $meResult['shop_name']; ?></td>
                            <td><?php echo intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543); ?></td>
                            <td><?php echo $time_a; ?></td>
                            <td><?php echo $meResult['orders_total_price']; ?></td>
                            <td><?php echo $meResult['orders_status_name']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-lg" href="orders_detail_shop.php?id=<?php echo $meResult["id_orders"];?>" role="button" target="_blank">
                                    ดูรายละเอียด</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
             </div>
              <div class='tab-pane <?=$p2?>' id="menu">
              <div style="text-align: right;">
                <ul class="nav nav-tabs">
                    <li class="<?=$head1?>"><a href="Home.php?state=1">รายการเมนู</a></li>
                    <li class="<?=$head2?>"><a href="Home.php?state=2">
                    <?php
                        if(strcmp("$p2_edit","active")==0){
                            echo "แก้ไขเมนู";
                        }
                        else{
                            echo "เพิ่มเมนู";
                        }
                    ?></a></li>                  
                </ul>
                </div>
                <?php
                    if(strcmp("$head1","active")==0){
                        echo'<table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>ราคา</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    ';
                    while ($meResult = mysqli_fetch_array($objQuery2))
                    {echo'
                        
                        <tr>
                            <td><img src="myfile/'.$meResult['FilesName'].'" width="120px" height="100px" border="0"></td>
                            
                            <td>'.$meResult['food_name'].'</td>
                            <td>'.$meResult['food_size'].'</td>
                            <td>'.number_format($meResult['food_cash'],2).'</td>
                            <td>
                                <a class="btn btn-primary btn-lg" href="Home.php?state=3&itemId='.$meResult["id_food"].'" role="button">
                                    แก้ไข</a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-lg" href="delete.php?itemId='.$meResult["id_food"].'" role="button">
                                <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>';
                    }
                echo '</tbody>
            </table>
                    
             </div>';
                }
                else if((strcmp("$head2","active")==0)&(!(strcmp("$p2_edit","active")==0))){
                    echo'
                        <form name="form1" method="post" action="add_data.php" enctype="multipart/form-data">
                            <input type="text" hidden name="shop_username" value='.$shop_username.'><br>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label><h4>name: </h4></label>
                                    <input type="text" name="food_name" value="" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label><h4>size: </h4></label>
                                    <input type="text" name="food_size" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>cash: </h4></label>
                                     <input type="text" name="food_cash" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Picture: </h4></label>
                                    <input type="file" name="filUpload" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input name="btnSubmit" type="submit" value="เพิ่มเมนู">
                                </div>
                            </div>
                            </form>
                    ';
                }
                else if((strcmp("$head2","active")==0)&(strcmp("$p2_edit","active")==0)){
                    $strSQL_edit = "SELECT * FROM food WHERE id_food = '".$_GET["itemId"]."' ;";
	                $objQuery_edit = mysqli_query($conn,$strSQL_edit) or die ("Error Query [".$strSQL_edit."]");
	                $objResult = mysqli_fetch_array($objQuery_edit);
                    echo'
                        <form name="form1" method="post" action="update_data.php?id_food='.$_GET["itemId"].'" enctype="multipart/form-data">
                            <input type="text" hidden name="shop_username" value='.$shop_username.'><br>
                            <input type="hidden" name="hdnOldFile" value="'.$objResult["FilesName"].'">
                            <img src="myfile/'.$objResult["FilesName"].'" width="270px" height="200px"><br><br>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>name: </h4></label>
                                <input type="text" name="food_name" value="'.$objResult["food_name"].'" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Size: </h4></label>
                                 <input type="text" name="food_size" value="'.$objResult["food_size"].'" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Cash: </h4></label>
                                <input type="text" name="food_cash" value="'.$objResult["food_cash"].'" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Picture : </h4></label>
                                <input type="file" name="filUpload"><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input name="btnSubmit" type="submit" value="แก้ไขเมนู">
                                </div>
                            </div>
                            </form>
                    ';
                }
            ?>
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>