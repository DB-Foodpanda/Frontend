<?php
session_start();
$id_shop = $_GET["shop"];
$cus_username = $_SESSION["cus_username"];
$vat = $_SESSION["vat"];
$total_price = $_SESSION["total_price"];
$formid = isset($_SESSION['formid']) ? $_SESSION['formid'] : "";
if ($formid != $_POST['formid']) {
	echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
	unset($_SESSION['formid']);
	$pay = $_POST["pay"];
	if ($_POST) {
		require 'connect.php';
		$meSql = "INSERT INTO `orders`(`Cus_username`,`orders_vat`,`orders_pay_type`,`id_orders_status`,`orders_total_price`, `orders_date_start_send`)
		 VALUES ('$cus_username',$vat,$pay,'1',$total_price,NOW()) ;";
		$meQeury = mysqli_query($meConnect,$meSql);

		if ($meQeury) {
			$order_id = mysqli_insert_id($meConnect);
			for ($i = 0; $i < count($_POST['qty']); $i++) {
				$order_detail_quantity = mysqli_real_escape_string($meConnect,$_POST['qty'][$i]);
				$order_detail_price = mysqli_real_escape_string($meConnect,$_POST['product_price'][$i]);
				$product_id = mysqli_real_escape_string($meConnect,$_POST['product_id'][$i]);
				$lineSql = "INSERT INTO orders_detail (id_food,orders_detail_item, id_orders) ";
				$lineSql .= "VALUES (";
				$lineSql .= "'{$product_id}',";
				$lineSql .= "'{$order_detail_quantity}',";
				$lineSql .= "'{$order_id}'";
				$lineSql .= ") ";
				mysqli_query($meConnect,$lineSql);
			}
			mysqli_close($meConnect);
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
			header("location:index_2.php?a=order&shop=".$id_shop."");
		}else{
			mysqli_close($meConnect);
			header("location:index_2.php?a=orderfail&shop=".$id_shop."");
		}
	}
}
