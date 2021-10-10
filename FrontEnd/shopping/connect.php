<?php
/*
 * set var
 */
$cfHost = "thoranin.org";
$cfUser = "proy3258";
$cfPassword = "Ns94ox^0";
$cfDatabase = "foodpanda";

/*
 * connection mysql
 */

$meConnect = mysqli_connect($cfHost, $cfUser, $cfPassword,$cfDatabase) or die("Error conncetion mysql...");

mysqli_set_charset($meConnect, "utf8");
?>
