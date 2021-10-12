<?php
session_start();
require('../connect.php');
if(empty($_SESSION["shop_username"])){
    header("location:../index.php");
}

$shop_username = $_SESSION["shop_username"]; 
  $sql = " SELECT * FROM `shop` 
  WHERE shop_username = '$shop_username' ; 
  ";

  $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");
  $objResult = mysqli_fetch_array($objQuery);

  $sql2 = " SELECT * 
    FROM `shop`
    WHERE shop.shop_username = '$shop_username' ;
    ";

  $objQuery2 = mysqli_query($conn, $sql2) or die("Error Query [" . $sql . "]");

  $sql3 = " SELECT *
  FROM `food`
  
  ";
    $objQuery3 = mysqli_query($conn, $sql3) or die("Error Query [" . $sql . "]");

    // $meSql = "SELECT * FROM `orders`
    // INNER JOIN orders_status
    // ON orders.orders_id = orders_status.orders_status_id
    // INNER JOIN food
    // ON orders_status.orders_status_id = food.food_id
    // INNER JOIN shop
    // ON food.food_id = shop.shop_id
    // INNER JOIN customer
    // ON shop.shop_id = customer.cus_id
    // WHERE shop.shop_username='$shop_username' AND orders_status.orders_status_id=2
    // ";
    
    $meSql = "SELECT * FROM `order` 
    JOIN order_details ON order.order_id = order_details.order_id
    JOIN food ON order_details.food_id = food.food_id 
    JOIN customer ON order.cus_id = customer.cus_id
    JOIN shop ON order.shop_id = shop.shop_id
    ";
    

    $objQuery1 = mysqli_query($conn,$meSql);
    // print_r($objQuery1);
    // echo($objQuery1);
    
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
    // $meSql ="GROUP BY orders.orders_id";
    // $objQuery1 = mysqli_query($conn, $meSql);
    // print_r ($shop_name);
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
  <title>Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="css/home.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row font1">
  		<div class="col-sm-10"><h1>ข้อมูลร้านค้า</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-responsive" src="https://www.khaosod.co.th/wpapp/uploads/2020/10/foodpanda-logo-696x448.png"></a></div>
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
            <!-- <div class="panel-body"> <p> คะแนนลูกค้า </p> </div> -->
            <form action="check_pass_shop.php" method="post">
                <div class="panel-body form-group">
                    <div class="col-xs" style="text-align: center;">
                        <img src="myfile/<?php echo $objResult['shop_image'];?>" width="120px" height="100px" border="0"><br>
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
                        <input type="submit" class="btn btn-lg button-pink" name="submit" value="แก้ไขข้อมูล" id="shop_password" placeholder="รหัสผ่าน">
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
                    <input type="text" disabled class="form-control" name="shop_earnprice" id="shop_earnprice" placeholder="รายได้รวม" value="<?php echo $objResult["shop_earnprice"];?>">
                </div>
            </div>

          </div>
          <div class="logout">
            <a href="../website/logout.php" class="btn btn-lg button-pink" >ออกจากระบบ</a>
          </div>

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
                              <label for="shop_name"><h4>ชื่อร้านค้า</h4></label>
                              <input type="text" class="form-control" Required <?php echo $show;?>  name="shop_name" id="shop_name" placeholder="ชื่อร้านค้า" title="กรุณากรอกชื่อร้านค้า" value="<?=$objResult["shop_name"];?>">
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
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_earnacc_no" id="shop_earnacc_no" placeholder="ใส่หมายเลขบัญชี" title="กรุณาใส่หมายเลขบัญชี" value="<?=$objResult["shop_earnacc_no"];?>">
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
                              <input type="text" class="form-control" Required <?php echo $show;?> name="shop_openday" id="shop_openday" placeholder="วันที่เปิด" title="กรุณาใส่วันที่เปิด" value="<?=$objResult["shop_openday"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_business_time_open_time"><h4>เวลาเปิดเริ่ม</h4></label>
                              <input type="time" class="form-control" Required <?php echo $show;?> name="shop_opentime" id="shop_opentime" placeholder="เวลาเปิดเริ่ม" title="เวลาเปิดเริ่ม" value="<?=$objResult["shop_opentime"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_business_time_close_time"><h4>ถึง</h4></label>
                              <input type="time" class="form-control" Required <?php echo $show;?> name="shop_closetime" id="shop_closetime" placeholder="เวลาเปิดถึง" title="เวลาเปิดถึง" value="<?=$objResult["shop_closetime"];?>">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-3">
                            <label for="shop_work_rate"><h4>เรทร้านค้า</h4></label>
                              <input type="text" class="form-control" disabled name="shop_rate" id="shop_rate" placeholder="เรทร้านค้า" title="เรทร้านค้า" value="<?=$objResult["shop_rate"];?>">
                          </div>
                      </div>
                      <div class="form-group">
                            <div class="col-xs-3">
                                <label for="shop_password"><h4>รหัสผ่านใหม่</h4></label>
                                <input type="text" class="form-control" <?php echo $show;?> name="shop_password" id="shop_new_password" placeholder="รหัสผ่านใหม่" title="รหัสผ่านใหม่" value="">
                            </div>
                        </div>
                      <div class="form-group">
                        <div class="col-xs-6">
                        <input type="hidden" name="hdnOldFile" value="<?php echo $objResult["shop_image"];?>">
                            <label for="filUpload"><h4>รูปภาพ</h4></label>
                            <input type="file" name="filUpload" class="form-control" <?php echo $show;?>>
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

          <!-- ------==START==------
                รายละเอียดหน้าออเดอร์
                ------=====------ -->
             
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
                <?php while($meResult = mysqli_fetch_array($objQuery1)):?>
                        <?php
                        $monthNamesThai = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                        $splitTimeStamp = explode(" ",$meResult["order_datestartsend"]);
                        $date_a = $splitTimeStamp[0];
                        $time_a = $splitTimeStamp[1];
                        $date = explode("-",$date_a);
                        ?>
                        <tr>
                            <td><?php echo $meResult['order_id']; ?></td>
                            <td><?php echo $meResult['cus_username']; ?></td>
                            <td><?php echo $meResult['shop_name']; ?></td>
                            <td><?php echo intval($date[2])." ".$monthNamesThai[$date[1]-1]." ".($date[0]+543); ?></td>
                            <td><?php echo $time_a; ?></td>
                            <td><?php echo $meResult['order_price']; ?></td>
                            <td><?php echo $meResult['order_status']; ?></td>
                        </tr>
                        <?php endwhile;?>
                </tbody>
            </table>

             <!-- ------==END==------
                รายละเอียดหน้าออเดอร์
                ------=====------ -->

             <!-- ------==START==------
                รายละเอียดหน้าจัดการเมนู
                ------=====------ -->
            

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
                    while ($meResult = mysqli_fetch_array($objQuery3))
                    {echo'
                        
                        <tr>
                            <td><img src="myfile/'.$meResult['food_image'].'" width="120px" height="120px" border="0"></td>
                            
                            <td>'.$meResult['food_name'].'</td>
                            <td>'.$meResult['food_size'].'</td>
                            <td>'.number_format($meResult['food_price'],2).'</td>
                            <td>
                                <a class="btn btn-primary btn-lg" href="Home.php?state=3&itemId='.$meResult["food_id"].'" role="button">
                                    แก้ไข</a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-lg" href="delete.php?itemId='.$meResult["food_id"].'" role="button">
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
                        <form class="form" name="form1" method="post" action="add_data.php" enctype="multipart/form-data">
                            <input type="text" hidden name="shop_username" value='.$shop_username.'><br>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label><h4>Name: </h4></label>
                                    <input type="text" class="form-control" name="food_name"Required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label><h4>Size: </h4></label>
                                    <input type="text" class="form-control" name="food_size" Required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                     <label><h4>Price: </h4></label>
                                     <input type="text" class="form-control" name="food_price" Required>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                <label><h4>Detail: </h4></label>
                                     <input type="text" class="form-control" name="food_detail" Required>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label><h4>Type: </h4></label>
                                     <input type="text" class="form-control" name="food_type" Required>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                <label><h4>Picture: </h4></label>
                                    <input type="file" class="form-control" name="filUpload" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input class="btn btn-lg button-pink" name="btnSubmit" type="submit" value="เพิ่มเมนู">
                                </div>
                            </div>
                            </form>
                    ';
                }
                else if((strcmp("$head2","active")==0)&(strcmp("$p2_edit","active")==0)){
                    $strSQL_edit = "SELECT * FROM food WHERE food_id = '".$_GET["itemId"]."' ;";
	                $objQuery_edit = mysqli_query($conn,$strSQL_edit) or die ("Error Query [".$strSQL_edit."]");
	                $objResult = mysqli_fetch_array($objQuery_edit);
                    echo'
                        <form name="form1" method="post" action="update_data.php?food_id='.$_GET["itemId"].'" enctype="multipart/form-data">
                            <input type="text" hidden name="shop_username" value='.$shop_username.'><br>
                            <input type="hidden" name="hdnOldFile" value="'.$objResult["food_image"].'">
                            <img src="myfile/'.$objResult["food_image"].'" width="200px" height="200px"><br><br>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Name: </h4></label>
                                <input type="text" class="form-control" name="food_name" value="'.$objResult["food_name"].'" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Size: </h4></label>
                                 <input type="text" class="form-control" name="food_size" value="'.$objResult["food_size"].'" Required><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Price: </h4></label>
                                <input type="text" class="form-control" name="food_price" value="'.$objResult["food_price"].'" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Detail: </h4></label>
                                <input type="text" class="form-control" name="food_detail" value="'.$objResult["food_detail"].'" Required><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                <label><h4>Picture : </h4></label>
                                <input type="file" class="form-control" name="filUpload"><br>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="btn btn-lg button-pink" name="btnSubmit" type="submit" value="แก้ไขเมนู">
                                </div>
                            </div>
                            </form>
                    ';
                }
            ?>
              </div>
              
               <!-- ------==END==------
                รายละเอียดหน้าจัดการเมนู
                ------=====------ --><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>