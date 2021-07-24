<?php 
 require('Top.inc.php');

//product status
if(isset($_GET['type']) && $_GET['type']=="active"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update categories set status = 1 where id = '$id'");
    }
}

if(isset($_GET['type']) && $_GET['type']=="deactive"){
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
         mysqli_query($conn,"update categories set status = 0 where id = '$id'");
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
          <h2>Product Category</h2>
        </div>

        <div class="addbtncontainer">
               <a href="Manage.category.php">Add Product</a>
        </div>
           

        <table class="styled-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Manage</th>                    
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                       $category_res = mysqli_query($conn,"select * from Categories");
                       $i=1;
                       while($category_row = mysqli_fetch_assoc($category_res)){?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $category_row['Category'] ?></td>
                            <td>
                            <?php if($category_row['status'] == 1){ ?>
                                  <a  class="btn" href="?type=deactive&id=<?php echo $category_row['id'] ?>">Active</a>
                               <?php }else{ ?>
                                  <a  class="btn" href="?type=active&id=<?php echo $category_row['id'] ?>">Dective</a>
                               <?php } ?>
                            </td>
                            <td>
                               <div class="flex">
                                    <a  class="btn" href="Manage.category.php?type=edit&id=<?php echo $category_row['id'] ?>">Edit</a>
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