<?php
include_once('inc/db.php');
$shopify = $_GET;

$sql="SELECT * FROM shop WHERE shop_url='" .$shopify['shop'] . "' LIMIT 1";
$res = mysqli_query($conn,$sql);

if(mysqli_num_rows($res)<1)
{
    header("Location: install.php?shop=" . $shopify['shop']);
    exit();

} else{
    $shop_row = mysqli_fetch_assoc($res);

    $shop_url = $shopify['shop'];
    $token = $shop_row['access_token'];

}
?>