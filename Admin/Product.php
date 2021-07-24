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

              <div class="addbtncontainer">
               <a href="Manage.product.php">Add Product</a>
              </div>
           

        <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                       $product_res = mysqli_query($conn,"select * from product order by id desc");
                       while($product_row = mysqli_fetch_assoc($product_res)){?>
                        <tr>
                            <td><?php echo $product_row['Product'] ?></td>
                            <td><img src="../images/Product/<?php echo $product_row['image'] ?>" /></td>
                            <td>
                                <?php 
                                $cat_res = mysqli_query($conn,"select * from categories where id ='".$product_row['category']."'");
                                $category_row = mysqli_fetch_assoc($cat_res); 
                                ?>
                                <?php echo $category_row['Category'] ?>
                            </td>
                            <td><?php echo $product_row['price'] ?></td>
                            <td>
                               <?php if($product_row['status'] == 1){ ?>
                                  <a  class="btn" href="?type=deactive&id=<?php echo $product_row['id'] ?>">Active</a>
                               <?php }else{ ?>
                                  <a  class="btn" href="?type=active&id=<?php echo $product_row['id'] ?>">Dective</a>
                               <?php } ?>
                            </td>
                            <td>
                               <div class="flex">
                                    <a  class="btn" href="Manage.product.php?type=edit&id=<?php echo $product_row['id'] ?>">Edit</a>
                                    <a  class="btn" href="?type=delete&id=<?php echo $product_row['id'] ?>">Delete</a>
                                </div> 
                            </td>
                      </tr>
            <?php } ?>
                      
                       
                      
                        <!-- and so on... -->
                    </tbody>
                </table>

   


    </div>
</div>

</div>
<?php require('Bottom.inc.php') ?>