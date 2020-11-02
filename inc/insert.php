<?php

include_once('db.php');
if(isset($_POST['submit'])){

$shopName = $_POST['shop'];
$acToken = $_POST['token'];
//echo $acToken;
echo $shopName;
$del  = "DELETE a.*, b.* FROM orders as a, order_items as b WHERE a.order_no = b.order_no AND a.shop_url = '$shopName'";

if(mysqli_query($conn,$del))
{

$orderApi = curl_init("https://a7c27e8f9be9114a91383bc3aac70e28:".$acToken."@".$shopName."/admin/api/2020-10/orders.json");
curl_setopt($orderApi, CURLOPT_FAILONERROR, true);
curl_setopt($orderApi, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($orderApi, CURLOPT_RETURNTRANSFER, true);
curl_setopt($orderApi, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($orderApi, CURLOPT_SSL_VERIFYPEER, false);  
$response = curl_exec($orderApi);

$ordList = json_decode($response);
//print_r($ordList);
 $fetchedOrders = $ordList->orders;  
  //print_r($fetchedOrders);

foreach ($fetchedOrders as $ordersElement) {

$orderNo = isset($ordersElement->id)?$ordersElement->id:null; 
$firstName = isset($ordersElement->billing_address->first_name)?$ordersElement->billing_address->first_name:null; 
$lastName = isset($ordersElement->billing_address->last_name)?$ordersElement->billing_address->last_name:null; 
$company = isset($ordersElement->billing_address->company)?$ordersElement->billing_address->company:null; 
$address = isset($ordersElement->billing_address->address1 )?$ordersElement->billing_address->address1:null; 
$city = isset($ordersElement->billing_address->city)?$ordersElement->billing_address->city:null; 
$state = isset($ordersElement->billing_address->state)?$ordersElement->billing_address->state:null; 
$country = isset($ordersElement->billing_address->country)?$ordersElement->billing_address->country:null; 
$amount = isset($ordersElement->total_price)?$ordersElement->total_price:null; 
$tax = isset($ordersElement->total_tax)?$ordersElement->total_tax:null; 


$orderQuery = "INSERT INTO `orders`(`shop_url`, `order_no`, `first_name`, `last_name`, `company`, `address`, `city`, `state`, `country`, `tax_amount`, `total_amount`) 
    VALUES ('$shopName','$orderNo','$firstName','$lastName','$company','$address','$city','$state','$country','$tax','$amount')";

if (mysqli_query($conn, $orderQuery)) {
	
    echo "inserted";

    
} 

else {	
    echo "Failed";

}


$itemsElementsArr =  array();

foreach ($ordersElement->line_items as $key => $item)
{
 
    $itemsElementsArr[$key] = $item; 

    $itemList = json_encode($itemsElementsArr);

    $itemQuery = "INSERT INTO `order_items`(`order_no`, `item`)VALUES ('$orderNo','$itemList')";


  if (mysqli_query($conn,$itemQuery))
    {
        echo 'item inserted';
    }
    else{
        echo'item insertion failed';
    }
}

}    
    header("Location:./index.php");
    
    }

else
{
echo 'refresh again';

}

     }//end for isset submit

?>