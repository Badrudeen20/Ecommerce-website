<?php 
require('Top.inc.php'); 
$id = 0;

if(isset($_GET['id']) && $_GET['id'] > 0){
     $id = $_GET['id'];
     $detail_res = mysqli_query($conn,"select product.*,categories.Category,producttype.Type from product,categories,producttype
      where product.id = '$id' and categories.id = product.category and producttype.id = product.type");
     $detail_row = mysqli_fetch_assoc($detail_res);
} 

?>
<!--Detail Product-->
<div class="detail-container">
    <div class="row">
        <div class="col-2">
          <img id="product_image" src="../images/product/<?php  echo $detail_row['image']?>" />
            <div class="img-container">
                <div class="img">
                  <img src="../images/product/<?php  echo $detail_row['image']?>" />
                </div>
                <?php 
                $detailimg_res = mysqli_query($conn,"select * from productimage where product_id = '$id'");
                $detailimg_row = mysqli_fetch_assoc($detailimg_res);?>
                <div class="img">
                   <img src="../images/detail/<?php  echo $detailimg_row['img1']?>" />
                </div>
                <div class="img">
                    <?php if($detailimg_row['img2']!=""){ ?>
                        <img src="../images/detail/<?php  echo $detailimg_row['img2']?>" />
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-2">
            <p><?php echo $detail_row['Category'] ?>/<?php echo $detail_row['Type'] ?></p>
            <h2><?php echo $detail_row['Product'] ?></h2>
            <h4>$<?php echo $detail_row['price'] ?>.00</h4>
            <h3>Product Detail</h3>
            <p class="short_desc"><?php echo $detail_row['description'] ?></p>
            <select id="size<?php echo $detail_row['id']?>">
                <option value="0">Select Size</option>
                   <?php
                     $product_size_res = mysqli_query($conn,"select * from productsize where category='".$detail_row['category']."' and type='".$detail_row['type']."'");
                     while($product_size_row = mysqli_fetch_assoc($product_size_res)){ ?>
                          <option><?php echo $product_size_row['size'] ?></option>
                    <?php } ?>
            </select>
           
            <input type="number"  id="qty<?php echo $detail_row['id'] ?>" onchange="checkqty('<?php echo $detail_row['id'] ?>')" value="1" />
            <br/>
            <button type="button" onclick="addCart('<?php echo $detail_row['id'] ?>','<?php echo $userid ?>','<?php echo $detail_row['price'] ?>')" class="btn">Add To Cart</button>
            
        </div>
    </div>
</div>

<div class="container">
 <div class="big-img">
     <img src="" />
     <div class="img-container">
         <img src=""/>
     </div>
 </div>
</div>
<script>
    var productImg =  document.getElementById('product_image')
     function checkqty(id){
        var qty = document.getElementById('qty'+id).value
            if(qty < 1){
                document.getElementById('qty'+id).value = 1
            } 
         }
        document.querySelectorAll('.img').forEach(function(ele){
             ele.addEventListener('click',function(){
                productImg.src = this.querySelector('img').src
             })
        })


    function addCart(id,userid,price){
        if(userid < 0) return
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