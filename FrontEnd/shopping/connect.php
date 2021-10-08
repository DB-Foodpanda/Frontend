<?php
/*
 * set var
 */
$cfHost = "localhost";
$cfUser = "root";
$cfPassword = "";
$cfDatabase = "foodpanda";

/*
 * connection mysql
 */

$meConnect = mysqli_connect($cfHost, $cfUser, $cfPassword,$cfDatabase) or die("Error conncetion mysql...");

mysqli_set_charset($meConnect, "utf8");
?>
