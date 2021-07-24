<?php 
include('Connection.inc.php');
$userid = 0;


if(isset($_SESSION['CUSTOMER'])){
    $userid = $_SESSION['CUSTOMER_ID'];
}
if(isset($_POST)){
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $appartment = $data->appartment;
    $city = $data->city;
    $post = $data->post;
    $email = $data->email;
    $phone = $data->phone;
    $payment_status  = $data->payment;
    $payment = "success";
    $total = $data->total;
    $addedon  = date('y-m-d:h-m');

   if($payment_status=="cash"){
        $payment="pending";
    }else{
        $payment="success";
    }

     if(mysqli_query($conn,"insert into order_master (userid,name,email,phone,address,city,post,total,payment_status,order_status,addedon)
     values('$userid','$name','$email','$phone','$appartment','$city','$post','$total','$payment','pending','$addedon')")){
        $order_master_id = mysqli_insert_id($conn);
         $cart_res =  mysqli_query($conn,"select * from cart where userid = '$userid'");
         while($cart_row  = mysqli_fetch_assoc($cart_res)){ 
              mysqli_query($conn,"insert into order_detail (order_master_id,product_id,size,price,qty,addedon)
               values('$order_master_id','".$cart_row['productid']."','".$cart_row['productsize']."','".$cart_row['productprice']."','".$cart_row['productqty']."','$addedon')");
         }
         
         if(mysqli_query($conn,"delete from cart where userid = '$userid'")){
             echo "success";
         }
     }
      
}else{
    echo "failed";
} 
?>