<?php
session_start();
require ('connect.php');
$id_shop = $_SESSION["shop_id"];
$shop_name = $_GET['shop'];
// echo($shop_name);
if($_GET['shop']){
    $sqlgetshop = "SELECT * FROM shop WHERE shop_username LIKE '%".$shop_name."%'";
    $getshop_id = mysqli_query($meConnect, $sqlgetshop);
    $objshop = mysqli_fetch_array($getshop_id);
    // print_r($objshop);
    // echo($objshop);
    // print_r($objshop);
    $id_shop = $objshop["shop_id"];
}
// echo($_GET['shop']);
// $_SESSION["shop"] = $id_shop;
$meSql = "SELECT * FROM food WHERE shop_id ='$id_shop'";
// $meSql = "SELECT * FROM food";
$meQuery = mysqli_query($meConnect,$meSql);
// print_r($meQuery);


// echo("<pre>");
// print_r($_SESSION);
// echo("</pre>");


// echo($_GET["shop"]);
// echo($_SESSION["shop"]);
//js -> console.log($meQuery)

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
                        <?php
                            $link = "";
                            if($meQty==0){
                                $link = "index.php";
                                $link1 = "../Home/index.php";
                            }
                            else{
                                $link = "index_2.php?a=finishOrder&shop=".$id_shop."";
                                $link1 = "../Home/index.php?shop=<?php echo $id_shop?>";
                            }
                            
                        ?>
                        <a class="navbar-brand" href= "../Home/index.php?shop=<?php echo $id_shop?>">Home</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href=<?php echo "$link"?>>หน้าแรกร้านค้า</a></li>
                            <li class="active"><a href="">หน้าแรกสินค้า</a></li>
                            <li><a href="cart.php?shop=<?php echo $id_shop;?>">ตะกร้าสินค้าของฉัน <span class="badge"><?php echo $meQty; ?></span></a></li>
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
                        <th>ราคา</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($meResult = mysqli_fetch_array($meQuery))
                    {
                        
                        ?>
                        <tr>
                            
                            <td><img src="../Shop/myfile/<?php echo $meResult['food_image'];?>" width="120px" height="100px" border="0"></td>
                            
                            <td><?php echo $meResult['food_name']; ?></td>
                            <td><?php echo $meResult['food_size']; ?></td>
                            <td><?php echo number_format($meResult['food_price'],2); ?></td>
                            <td>
                                <a class="btn btn-primary btn-lg" href="updatecart.php?itemId=<?php echo $meResult["food_id"];?>&shop=<?php echo $id_shop?>" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    หยิบใส่ตะกร้า</a>
                            </td>
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
