<?php
include('Connection.inc.php');

if(isset($_POST)){
    $data = json_decode(file_get_contents("php://input"));
    $cartId = $data->cartId;
    $productQty = $data->productQty;
    $productId = $data->productId;
    $addedon = date('y-m-d');
     if(mysqli_query($conn,"update cart set productqty = '$productQty' where id = '$cartId'")){
        $product_price_res =  mysqli_query($conn,"select price from product where id = '$productId'");
        $price = mysqli_fetch_assoc($product_price_res);
        echo $price['price'];
     }
   
}
?>