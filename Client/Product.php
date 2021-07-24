<?php 
require('Top.inc.php');
$id=0;
$type = 0;

if(isset($_GET['id']) && $_GET['id'] >0){
     $id = $_GET['id'];
} 

if(isset($_GET['type']) && $_GET['type'] >0){
    $type = $_GET['type'];
} 


?>
 
<!--product page-->
<div class="product-container">
    <div class="top-fun">
        <select onchange="selectType('<?php echo $id ?>')" id="type">
            <option value="0">All Selected</option>
            <?php 
            $select_res = mysqli_query($conn,"select * from producttype where status = 1");
            while($select_row = mysqli_fetch_assoc($select_res)){ ?>

              <?php
              $check_res = mysqli_query($conn,"select id,type from Product where category = '$id' GROUP BY type");
              while($check_row = mysqli_fetch_assoc($check_res)){
                   if($select_row['id']==$check_row['type']){ ?>
                  <?php if($select_row['id'] == $type){ ?>
                    <option value="<?php echo $select_row['id'] ?>" selected><?php echo $select_row['Type'] ?></option>
                 <?php }else{ ?>   
                    <option value="<?php echo $select_row['id'] ?>" ><?php echo $select_row['Type'] ?></option>
                 <?php } ?>

                <?php }
                 }  
              ?>
           
                





            <?php } ?>
        </select>
        <div> 
            <span id="grid" class="ion-grid"></span>
            <span id="detail" class="ion-android-storage"></span>
        </div>
        
    </div>
    
    <div id="product" class="row">
        <?php
        $typeCondition = ""; 
      if($type >0) {
             $typeCondition = "and product.type = '$type' ";
        }
     
      $product_res = mysqli_query($conn,"select product.*,categories.Category,producttype.Type from product,categories,producttype
          where product.category = '$id' $typeCondition and categories.id = product.category and producttype.id = product.type");
          while($product_row = mysqli_fetch_assoc($product_res)){ ?>
                <div class="col-1">
            <div class="img-container">
               <a href="Detail.php?id=<?php echo $product_row['id'] ?>"><img src="../images/product/<?php echo $product_row['image'] ?>" /></a>
            </div>
            <div class="product-detail-container">
                <h2><?php echo $product_row['Product'] ?></h2>
                <p>$<?php echo $product_row['price'] ?>.00</p>
                <p class="short_desc"><?php echo $product_row['description'] ?></p>
                <select class="size" id="size<?php echo $product_row['id']?>">
                    <option value="0">Select Size</option>
                    <?php
                     $product_size_res = mysqli_query($conn,"select * from productsize where category='$id' and type='".$product_row['type']."'");
                     while($product_size_row = mysqli_fetch_assoc($product_size_res)){ ?>
                          <option><?php echo $product_size_row['size'] ?></option>
                    <?php } ?>
                        
                   
                    
                </select>
                       
                <input type="number" value="1" id="qty<?php echo $product_row['id'] ?>" onchange="checkqty('<?php echo $product_row['id'] ?>')" />
                <button class="btn" onclick="addCart('<?php echo $product_row['id'] ?>','<?php echo $userid ?>','<?php echo $product_row['price'] ?>')">Add To Cart</button>
            </div>
        </div>
        <?php } ?>


    </div>
</div>



<!--Pagination container-
<div class="pagination-container">
    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#" class="active">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
      </div>
</div>-->
<script>
    function selectType(id){
        
        var type = document.getElementById('type').value
        if(type>0){
            window.location.href="?id="+id+"&type="+type
        }else{
            window.location.href="?id="+id
        } 
    }


    function checkqty(id){
        var qty = document.getElementById('qty'+id).value
            if(qty < 1){
                document.getElementById('qty'+id).value = 1
            } 
    }

    
   function addCart(id,userid,price){
       if(userid <= 0) return
        var size = document.getElementById('size'+id).value
        var qty = document.getElementById('qty'+id).value
        if(size==0 || userid==0) return

        var xhttp = new XMLHttpRequest()
        xhttp.open('post','Addcart.php',true)
        xhttp.setRequestHeader("Content-Type","application/json")
        xhttp.onreadystatechange = function(){
             if(this.readyState==4 && this.status==200){
                 var res = this.responseText
                 if(res!="update"){
                    document.getElementById('cart').innerHTML = res
                 }else{
                     console.log(res)
                 }
             }
        }

        var data = {productId:id,userId:userid,productSize:size,productQty:qty,productPrice:price}
        xhttp.send(JSON.stringify(data)) 
    }
</script>


<?php require('Bottom.inc.php') ?>