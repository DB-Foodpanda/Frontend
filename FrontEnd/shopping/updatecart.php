<?php

session_start();
$id_shop = $_GET["shop"];
$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
if ($_POST)
{
    for ($i = 0; $i < count($_POST['qty']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['qty'][$key] = $_POST['qty'][$i];
        //echo "location:cart.php?shop=".$id_shop."";
        header("location:cart.php?shop=".$id_shop."");
    }
} else
{
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['qty'][] = array();
    }

    if (in_array($itemId, $_SESSION['cart']))
    {
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['qty'][$key] = $_SESSION['qty'][$key] + 1;
        //echo "location:index_2.php?a=exists&shop=".$id_shop."";
        header("location:index_2.php?a=exists&shop=".$id_shop."");
    } else
    {
        array_push($_SESSION['cart'], $itemId);
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['qty'][$key] = 1;
        //echo "location:index_2.php?a=add&shop=".$id_shop."";
        header("location:index_2.php?a=add&shop=".$id_shop."");
    }
}
?>