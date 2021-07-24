<?php
 require('Top.inc.php');


  //edit
  $id = 0;
  $category = "";
  $msg = "";
  if(isset($_GET['type']) && $_GET['type']=="edit"){
    if(isset($_GET['id'])&& $_GET['id'] >0){
        $id = $_GET['id'];
        $edit_res = mysqli_query($conn,"select * from categories where id = '$id'");
        $edit_row = mysqli_fetch_assoc($edit_res);
        $category = $edit_row['Category'];
        
    }
  }
  


 if(isset($_POST['submit'])){
    $category = $_POST['category'];

    //check
    if(mysqli_num_rows(mysqli_query($conn,"select * from categories where Category = '$category'"))>0){
        if($id > 0){
            $edit_check_res = mysqli_query($conn,"select * from categories where Category = '$category' and id = '$id'");
            if(mysqli_fetch_assoc($edit_check_res) > 0){
                mysqli_query($conn,"update categories set Category = '$category' where id = '$id'");
            }else{
                $msg="Already Exist";
            }
          }else{
            $msg="Already Exist";
          }
    }
   
    //update category
    if($msg=="" && $id > 0){
        mysqli_query($conn,"update categories set Category = '$category' where id = '$id'");
        redirect('Category.php');
    }
  

    //insert category
    if($msg=="" && $id <= 0){
        mysqli_query($conn,"insert into categories (Category,status) 
        values('$category','1')");
        redirect('Category.php');
    }
   
   

} 
?>
         <form method="post" enctype='multipart/form-data'>
                 <h2>Manage Product</h2>
                <div class="form-group">
                    <label>Product</label>
                    <input type="text" name="category" value="<?php echo $category ?>" placeholder="Name of Category" required/>
                </div>
              
                <button type="submit" name="submit">Submit</button>
                  <p class="msg"><?php echo $msg ?></p>
            </form>
  
  
<?php require('Bottom.inc.php') ?>