<?php
session_start();
require 'connect.php';
$id_shop = $_GET["shop"];
$_SESSION["shop"] = $id_shop;

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = (int)$meQty + (int)$meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    //echo $inputItems;
    $parts=explode(",",$inputItems);
    $parts=array_filter($parts);
    $inputItems = implode(",",$parts);
    //echo "$inputItems";
    $meSql = "SELECT * FROM food WHERE food_id in ({$inputItems})";
    $meQuery = mysqli_query($meConnect,$meSql);
    $meCount = mysqli_num_rows($meQuery);
} else
{
    $meCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>shopping cart</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/nava.css" rel="stylesheet">

        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

    </head>
    <body>
        <div class="container">

            <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index_2.php?shop=<?php echo $id_shop;?>">หน้าแรกสินค้า</a></li>
                            <li class="active" ><a href="cart.php?shop=<?php echo $id_shop;?>">ตะกร้าสินค้าของฉัน <span class="badge"><?php echo $meQty; ?></span></a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>
			<h3>ตะกร้าสินค้าของฉัน</h3>
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
            }

            if ($meCount == 0)
            {
                $_SESSION["buy"] = true;
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            { $_SESSION["buy"] = false;
                ?>
                <form action="updatecart.php?shop=<?php echo $id_shop?>" method="post" name="fromupdate">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                            
                                <th>ชื่อสินค้า</th>
                                <th>ขนาดของสินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_array($meQuery))
                            {
                                $key = array_search($meResult['food_id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['food_price'] * $_SESSION['qty'][$key]);
                                ?>
                                <tr>
                                    <td><img src="../Shop/myfile/<?php echo $meResult['food_image']; ?>" width="120px" height="120px" border="0"></td>
                                    <td><?php echo $meResult['food_name']; ?></td>
                                    <td><?php echo $meResult['food_size']; ?></td>
                           
                                    <td>
                                        <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                        <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                    </td>
                                    <td><?php echo number_format($meResult['food_price'],2); ?></td>
                                    <td><?php echo number_format(($meResult['food_price'] * $_SESSION['qty'][$key]),2); ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-lg" href="removecart.php?itemId=<?php echo $meResult["food_id"]; ?>&shop=<?php echo $id_shop?>" role="button">
                                            <i class="fa fa-trash"></i>
                                            ลบทิ้ง</a>
                                    </td>
                                </tr>
                                <?php
                                $num++;
                            }
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price,2); ?> บาท</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                                    <a href="checkout.php?shop=<?php echo $id_shop?>" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
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
