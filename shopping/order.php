<?php
session_start();
require 'connect.php';
$cus_username = $_SESSION["cus_username"];
$Cus_address = $_SESSION["cus_address"] ;
$id_shop = $_GET["shop"];
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());
if (isset($_SESSION['qty'])) {
	$meQty = 0;
	foreach ($_SESSION['qty'] as $meItem) {
		$meQty = (int)$meQty + (int)$meItem;
	}
} else {
	$meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0) {
	$itemIds = "";
	foreach ($_SESSION['cart'] as $itemId) {
		$itemIds = $itemIds . $itemId . ",";
	}
	$inputItems = rtrim($itemIds, ",");
	$meSql = "SELECT * FROM food WHERE id_food in ({$inputItems})";
	$meQuery = mysqli_query($meConnect,$meSql);
	$meCount = mysqli_num_rows($meQuery);
} else {
	$meCount = 0;
}
$Sql = "SELECT * FROM customer WHERE cus_username = '$cus_username' ";
$Query = mysqli_query($meConnect,$Sql);
$obj = mysqli_fetch_array($Query); 
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
<script type="text/javascript">
	function updateSubmit(){
		if(document.formupdate.order_fullname.value == ""){
			alert('โปรดใส่ชื่อนามสกุลด้วย!');
			document.formupdate.order_fullname.focus();
			return false;
		}
			if(document.formupdate.order_address.value == ""){
			alert('โปรดใส่ที่อยู่ด้วย!');
			document.formupdate.order_address.focus();
			return false;
		}
			if(document.formupdate.order_phone.value == ""){
			alert('โปรดใส่เบอร์โทรด้วย!');
			document.formupdate.order_phone.focus();
			return false;
		}
		document.formupdate.submit();
		return false;
	}
</script>
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
                        <a class="navbar-brand" href="#">Shopping Cart - ItOffside.com</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index_2.php?shop=<?php echo $id_shop?>">หน้าแรกสินค้า</a></li>
                            <li><a href="cart.php?shop=<?php echo $id_shop?>">ตะกร้าสินค้าของฉัน <span class="badge"><?php echo $meQty; ?></span></a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>
			<h3>รายการสั่งซื้อ</h3>
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
            }

            if ($meCount == 0)
            {
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            {
                ?>
                
                <form action="updateorder.php?shop=<?php echo $id_shop?>" method="POST" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
                	<div class="form-group">
    					<label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
    					<input type="text" class="form-control" disabled id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" name="order_fullname" value = "<?php echo $obj["Cus_Name"];?>">
  					</div>
                	<div class="form-group">
    					<label for="exampleInputAddress">ที่อยู่</label>
    					<input class="form-control" disabled rows="3" style="width: 500px;" name="order_address" id="order_address" value="<?php echo $Cus_address;?>" ></input>
  					</div>
                	<div class="form-group">
    					<label for="exampleInputPhone">เบอร์โทรศัพท์</label>
    					<input type="text" disabled class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone" value=<?php echo $obj["Cus_tel"];?>>
  					</div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                
                                <th>ชื่ออาหาร</th>
                                <th>ขนาดของอาหาร</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_array($meQuery))
                            {
                                $key = array_search($meResult['id_food'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['food_cash'] * $_SESSION['qty'][$key]);
                                $vat = $total_price*0.07;
                                $total_price_non_vat = $total_price;
                                $total_price = $total_price+$vat;
                                $_SESSION["total_price"] = $total_price;
                                $_SESSION["vat"] = $vat;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $meResult['food_name']; ?></td>
                                    <td><?php echo $meResult['food_size']; ?></td>
                                    <td>
                                    	<?php echo $_SESSION['qty'][$key]; ?>
                                    	<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                    	<input type="hidden" name="product_id[]" value="<?php echo $meResult['id_food']; ?>" />
                                    	<input  type="hidden" name="product_price[]" value="<?php echo $meResult['food_cash']; ?>" />
                                    </td>
                                    <td><?php echo number_format($meResult['food_cash'], 2); ?></td>
                                    <td><?php echo number_format(($meResult['food_cash'] * $_SESSION['qty'][$key]), 2); ?></td>
                                </tr>
                                <?php
								$num++;
								}
                            ?>
                            <tr>
                            <td colspan="8" style="text-align: right;">
                                    <h4>จำนวนเงินไม่รวมภาษี <?php echo number_format($total_price_non_vat, 2); ?> บาท</h4>
                                    <h4>Vat. <?php echo number_format($vat, 2); ?> บาท</h4>
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                                </td>
                            </tr>
                            <tr>
                                <p>ชำระเงินผ่าน :</p>
                                <input type="radio" id="cash" checked name="pay" value="0">
                                <label for="cash">เงินสด</label><br>
                                <input type="radio" id="credit" name="pay" value="1">
                                <label for="credit">บัตรเครดิต</label><br>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                	<input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                                	<a href="cart.php?shop=<?php echo $id_shop?>" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-primary btn-lg" value="result" name="result">บันทึกการสั่งซื้อสินค้า</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
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
