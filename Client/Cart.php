<?php
require('Top.inc.php');
$id = 0;
if(!isset($_SESSION['CUSTOMER'])){
    redirect('Home.php');
}

//delete item 
if(isset($_GET['type']) && $_GET['type']=="delete"){ 
    if($_GET['id'] > 0){
        $id = $_GET['id'];
        mysqli_query($conn,"delete from cart where id = '$id'");
    }
} 


?>
<div class="cart-container">
      <table>
          <thead>
              <tr>
                  <th>Product</th>
                  <th>Qunatity</th>
                  <th>Subtotal</th>
              </tr>
          </thead>
          <tbody>
            <?php 
               $cart_res = mysqli_query($conn,"select cart.*,product.Product,product.image,product.price from cart,product where cart.userid = '$userid' and product.id = cart.productid");
               if(mysqli_num_rows($cart_res) > 0){
                 while($cart_row = mysqli_fetch_assoc($cart_res)){ ?>
                    <tr>
                 <td>
                     <div class="cart-info">
                         <img src="../images/product/<?php echo $cart_row['image'] ?>" />
                         <div>
                             <p><?php echo $cart_row['Product'] ?></p>
                             <small>Size:<?php echo $cart_row['productsize'] ?></small></br/>
                             <small>price:$<?php echo $cart_row['price'] ?>.00</small><br/>
                             <a href="?type=delete&id=<?php echo $cart_row['id'] ?>">Remove</a>
                         </div>
                     </div>
                 </td>
                 <td><input type="number" id="qty<?php echo $cart_row['id'] ?>"  onchange="checkqty('<?php echo $cart_row['id'] ?>','<?php echo $cart_row['productid'] ?>')" value="<?php echo $cart_row['productqty'] ?>"></td>
                 <td >$<span id="subTotal<?php echo $cart_row['id'] ?>"><?php echo $cart_row['price'] * $cart_row['productqty'] ?></span>.00</td>
              </tr>   
            <?php }
               }else{
            ?>
               <tr>
                   <td>No item in cart</td>
               </tr>
             <?php  } ?>

           
          </tbody>
      </table>
      <div class="checkout">
          <?php if(mysqli_num_rows(mysqli_query($conn,"select * from cart where userid = '$userid'")) > 0){ ?>
            <a href="Checkout.php" class="btn">checkout<span class="ion-ios7-arrow-thin-right"></span></a>
          <?php } ?>
      </div>
  </div>

<script>
       function checkqty(id,productid){
           var qty = document.getElementById('qty'+id).value
               if(qty < 1){
                 document.getElementById('qty'+id).value = 1
                 return
               } 

            var xhttp = new XMLHttpRequest()
             xhttp.open('post','Updatecart.php',true)
             xhttp.setRequestHeader("Content-Type","application/json")
             xhttp.onreadystatechange = function(){
             if(this.readyState==4 && this.status==200){
                 var res = this.responseText
                 document.getElementById('subTotal'+id).innerHTML = parseInt(res) * qty
                
             }
        }

        var data = {cartId:id,productQty:qty,productId:productid}
        xhttp.send(JSON.stringify(data)) 

         }

         
</script>




<?php require('Bottom.inc.php') ?>