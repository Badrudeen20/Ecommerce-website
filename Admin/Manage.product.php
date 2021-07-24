<?php
 require('Top.inc.php');


  //edit
  $id = 0;
  $product = "";
  $description = '';
  $price = "";
  $category = "";
  $type = "";
  $imgRequired = "required";
  $msg = "";
  if(isset($_GET['type']) && $_GET['type']=="edit"){
    if(isset($_GET['id'])&& $_GET['id'] >0){
        $imgRequired = "";
        $id = $_GET['id'];
        $edit_res = mysqli_query($conn,"select * from product where id = '$id'");
        $edit_row = mysqli_fetch_assoc($edit_res);
        $product = $edit_row['Product'];
        $category = $edit_row['category'];
        $type = $edit_row['type'];
        $price = $edit_row['price'];
        $description = $edit_row['description'];
        
    }
  }
  


 if(isset($_POST['submit'])){
    $product = $_POST['product'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    //check
    if($id > 0){
        if(mysqli_num_rows(mysqli_query($conn,"select * from product where Product = '$product' and id = '$id'"))>0){    
            $imgcontainer = "";
            if($_FILES['image']['name']!=""){
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],FILE_PATH.$_FILES['image']['name']);
                $imgcontainer = "image='$image',";
            }
          if(mysqli_query($conn,"update product set Product='$product', $imgcontainer category = '$category', type='$type',
          description = '$description',price = '$price' where id = '$id'")){
              if($_FILES['detailimage2']['name']!=""){
                $detailimg2 = $_FILES['detailimage2']['name'];
                move_uploaded_file($_FILES['detailimage2']['tmp_name'],IMG_PATH.$_FILES['detailimage2']['name']);
                mysqli_query($conn,"update productimage set img2 =  '$detailimg2' where product_id = '$id'");
              } 

              if($_FILES['detailimage1']['name']!=""){
                $detailimg1 = $_FILES['detailimage1']['name'];
                move_uploaded_file($_FILES['detailimage1']['tmp_name'],IMG_PATH.$_FILES['detailimage1']['name']);
                mysqli_query($conn,"update productimage set img1 =  '$detailimg1' where product_id = '$id'");
              }
              redirect('Product.php');
          }
          

        }else{
            if(mysqli_num_rows(mysqli_query($conn,"select * from product where Product = '$product'"))>0){
                $msg="Already Exist";
            }else{
                $imgcontainer = "";
                if($_FILES['image']['name']!=""){
                    $image = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],FILE_PATH.$_FILES['image']['name']);
                    $imgcontainer = "image='$image',";
                }
              if(mysqli_query($conn,"update product set Product='$product', $imgcontainer category = '$category',  type='$type',
              description = '$description',price = '$price' where id = '$id'")){
                if($_FILES['detailimage2']['name']!=""){
                    $detailimg2 = $_FILES['detailimage2']['name'];
                    move_uploaded_file($_FILES['detailimage2']['tmp_name'],IMG_PATH.$_FILES['detailimage2']['name']);
                    mysqli_query($conn,"update productimage set img2 =  '$detailimg2' where product_id = '$id'");
                  } 
    
                  if($_FILES['detailimage1']['name']!=""){
                    $detailimg1 = $_FILES['detailimage1']['name'];
                    move_uploaded_file($_FILES['detailimage1']['tmp_name'],IMG_PATH.$_FILES['detailimage1']['name']);
                    echo "update productimage set img1='$detailimg1' where product_id = '$id'";
                    mysqli_query($conn,"update productimage set img1='$detailimg1' where product_id = '$id'");
                  }
                  redirect('Product.php');
              }
             
            }
        }



    }else{

        if(mysqli_num_rows(mysqli_query($conn,"select * from product where Product = '$product'"))>0){
            echo "badru";
            $msg="Already Exist";
        }
    }
   


    if($msg=="" && $id <= 0){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],FILE_PATH.$_FILES['image']['name']);
        if(mysqli_query($conn,"insert into product (Product,image,category,type,description,price,status) 
        values('$product','$image','$category','$type','$description','$price','1')")){
            $getproductid  = mysqli_insert_id($conn);
           
            //detailimage two
           if($_FILES['detailimage2']['name']!=""){
              $detailimg1 = $_FILES['detailimage1']['name'];
              move_uploaded_file($_FILES['detailimage1']['tmp_name'],IMG_PATH.$_FILES['detailimage1']['name']);
              $detailimg2 = $_FILES['detailimage2']['name'];
              move_uploaded_file($_FILES['detailimage2']['tmp_name'],IMG_PATH.$_FILES['detailimage2']['name']);
              mysqli_query($conn,"insert into productimage (product_id,img1,img2) values('$getproductid','$detailimg1','$detailimg2')");
           }else{
                 //detailimage one
              $detailimg1 = $_FILES['detailimage1']['name'];
              move_uploaded_file($_FILES['detailimage1']['tmp_name'],IMG_PATH.$_FILES['detailimage1']['name']);
              mysqli_query($conn,"insert into productimage (product_id,img1) values('$getproductid','$detailimg1')");
           }

        }  
        
        redirect('Product.php');

    }
   
   

} 
?>
         <form method="post" enctype='multipart/form-data'>
                 <h2>Manage Product</h2>
                <div class="form-group">
                    <label>Product</label>
                    <input type="text" name="product" value="<?php echo $product ?>" placeholder="Name of Product" required/>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="file-wrap" data-name="Select Image">
                        <input type="file" name="image"  <?php echo $imgRequired ?>/>
                    </div>
                   
                </div>


                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <?php 
                          $option_res = mysqli_query($conn,"select * from categories where status = 1");
                          while($option_row = mysqli_fetch_assoc($option_res)){ ?>
                             <?php if($option_row['id'] == $category){ ?>
                                <option value="<?php echo $option_row['id'] ?>" selected><?php echo $option_row['Category'] ?></option>  
                              <?php }else{ ?>
                                <option value="<?php echo $option_row['id'] ?>" ><?php echo $option_row['Category'] ?></option>
                              <?php  } ?>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select name="type">
                        <?php 
                        $type_res = mysqli_query($conn,"select * from producttype");
                         while($type_row = mysqli_fetch_assoc($type_res)){ ?>
                          <?php  if($type_row['id']==$type){ ?>
                          <option value="<?php echo $type_row['id'] ?>" selected><?php echo $type_row['Type'] ?></option>
                          <?php  }else{ ?>
                            <option value="<?php echo $type_row['id'] ?>"><?php echo $type_row['Type'] ?></option>
                       <?php   } ?>
                      <?php  }?>
                        <option></option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" value="<?php echo $price ?>" placeholder="Name Of Product" required/>
                </div>

                

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required><?php echo $description ?></textarea>
                </div>


                <div class="flex-block">

                    <div class="form-group">
                        <label>Detail Image</label>
                      <div class="file-wrap" data-name="Select Image">
                         <input type="file"  name="detailimage1"  <?php echo  $imgRequired ?>/>
                      </div>
                   </div>

                   <div class="form-group">
                         <label>Detail Image</label>
                       <div class="file-wrap" data-name="Select Image">
                         <input type="file"   name="detailimage2"  />
                       </div>
                   </div>

               </div>


                <button type="submit" name="submit">Submit</button>
                  <p class="msg"><?php echo $msg ?></p>
            </form>
  
  
<?php require('Bottom.inc.php') ?>