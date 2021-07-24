<?php 
require('Top.inc.php');
//product status
if(isset($_GET['type']) && $_GET['type']=="active"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update producttype set status = 1 where id = '$id'");
    }
}

if(isset($_GET['type']) && $_GET['type']=="deactive"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update producttype set status = 0 where id = '$id'");
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
          <h2>Product Type</h2>
        </div>

        <div class="addbtncontainer">
               <a href="Manage.Product.type.php">Add Product</a>
        </div>
           

        <table class="styled-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Manage</th>                    
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                       $type_res = mysqli_query($conn,"select * from producttype");
                       $i=1;
                       while($type_row = mysqli_fetch_assoc($type_res)){?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $type_row['Type'] ?></td>
                            <td>
                            <?php if($type_row['status'] == 1){ ?>
                                  <a  class="btn" href="?type=deactive&id=<?php echo $type_row['id'] ?>">Active</a>
                               <?php }else{ ?>
                                  <a  class="btn" href="?type=active&id=<?php echo $type_row['id'] ?>">Dective</a>
                               <?php } ?>
                            </td>
                            <td>
                               <div class="flex">
                                    <a  class="btn" href="Manage.Product.type.php?type=edit&id=<?php echo $type_row['id'] ?>">Edit</a>
                                </div> 
                            </td>
                      </tr>
            <?php $i++; } ?>
                      
                       
                      
                        <!-- and so on... -->
                    </tbody>
                </table>

   


    </div>
</div>

</div>
<?php require('Bottom.inc.php') ?>