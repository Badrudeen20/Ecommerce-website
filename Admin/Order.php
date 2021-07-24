<?php 
 require('Top.inc.php');

 //delete product
if(isset($_GET['type']) && $_GET['type']=="delete"){
     if(isset($_GET['id']) && $_GET['id'] > 0){
         $id = $_GET['id'];
          if(mysqli_query($conn,"delete from product where id = '$id'")){
              mysqli_query($conn,"delete from productimage where product_id = '$id'");
          }
     }
}
//product status
if(isset($_GET['type']) && $_GET['type']=="active"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update product set status = '1' where id = '$id'");
    }
}

if(isset($_GET['type']) && $_GET['type']=="deactive"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update product set status = '0' where id = '$id'");
    }
}

?>
<div class="cardBox">
<!--card-->
<div class="card">
    <div>
        <div class="num">1,300</div>
        <div class="cardName">Orders</div>
    </div>
    <div class="iconBox">
        <i class="fi-rr-shopping-bag"></i>
    </div>
</div>
 <!--card-->
<div class="card">
    <div>
        <div class="num">300</div>
        <div class="cardName">Customer</div>
    </div>
    <div class="iconBox">
        <i class="fi-rr-users"></i>
    </div>
</div>
 <!--card-->
<div class="card">
    <div>
        <div class="num">5,300</div>
        <div class="cardName">Product</div>
    </div>
    <div class="iconBox">
        <i class="fi-rr-box"></i>
    </div>
</div>
 <!--card-->
<div class="card">
    <div>
        <div class="num">120</div>
        <div class="cardName">Employee</div>
    </div>
    <div class="iconBox">
        <i class="fi-rr-user"></i>
    </div>
</div>
</div>


<!--Detail Table Show-->
<div class="details">
     <div class="recentOrders">
               <div class="cardHeader">
                    <h2>Product Detail</h2>
                </div>
           

        <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Name/Email/Phone</th>
                            <th>Address</th>
                            <th>Order Detail</th>
                            <th>Total Price</th>
                            <th>Payment</th>
                            <th>Order</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php
                     $order_res = mysqli_query($conn,"select * from order_master order by id desc");
                     while($order_row = mysqli_fetch_assoc($order_res)){ ?>
                         <tr>
                             <td>
                                <?php echo $order_row['name'] ?>,<br/>
                                <?php echo $order_row['email'] ?>,<br/>
                                <?php echo $order_row['phone'] ?><br/>
                             </td>
                             <td><?php echo $order_row['address'] ?>,<br/>
                                 <?php echo $order_row['city'] ?>,<br/>
                                 <?php echo $order_row['post'] ?></td>
                             <td>
                               <table>
                                  <tr>
                                     <th>Name</th>
                                     <th>Category</th>
                                     <th>Size</th>
                                     <th>Price</th>
                                     <th>Quantity</th>
                                  </tr>
                                 <?php
                                   $detail_sql = "select order_detail.price,order_detail.qty,order_detail.size,product.Product,product.type,producttype.Type from order_detail,product,producttype 
                                   where order_detail.order_master_id = '".$order_row['id']."' and order_detail.product_id = product.id and producttype.id = product.type";
                                   $detail_res = mysqli_query($conn,$detail_sql);
                                   while($detail_row = mysqli_fetch_assoc($detail_res)){ ?>
                                  <tr>
                                        <td><?php echo $detail_row['Product'] ?></td>
                                        <td><?php echo $detail_row['Type'] ?></td>
                                        <td><?php echo $detail_row['size'] ?></td>
                                        <td><?php echo $detail_row['price'] ?></td>
                                        <td><?php echo $detail_row['qty'] ?></td> 
                                  </tr>
                            <?php  } ?>
                               </table>
                            </td>
                                <td><?php echo $order_row['total'] ?></td>
                                <td><?php echo $order_row['payment_status'] ?></td>
                                <td><?php echo $order_row['order_status'] ?></td>
                                <td><?php echo $order_row['addedon'] ?></td>
                        </tr>
                    <?php } ?>

                        <!-- and so on... -->
                    </tbody>
                </table>

   


    </div>
</div>

</div>
<?php require('Bottom.inc.php') ?>