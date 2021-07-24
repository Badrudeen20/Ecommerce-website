<?php
 require('Top.inc.php');


  //edit
  $id = 0;
  $type = "";
  $msg = "";
  if(isset($_GET['type']) && $_GET['type']=="edit"){
    if(isset($_GET['id'])&& $_GET['id'] >0){
        $id = $_GET['id'];
        $edit_res = mysqli_query($conn,"select * from producttype where id = '$id'");
        $edit_row = mysqli_fetch_assoc($edit_res);
        $type = $edit_row['Type'];
        
    }
  }
  


 if(isset($_POST['submit'])){
    $type = $_POST['type'];

    //check
    if(mysqli_num_rows(mysqli_query($conn,"select * from producttype where Type = '$type'"))>0){
        if($id > 0){
            $edit_check_res = mysqli_query($conn,"select * from producttype where Type = '$type' and id = '$id'");
            if(mysqli_fetch_assoc($edit_check_res) > 0){
                mysqli_query($conn,"update producttype set Type = '$type' where id = '$id'");
            }else{
                $msg="Already Exist";
            }
          }else{
            $msg="Already Exist";
          }
    }
   
    //update category
    if($msg=="" && $id > 0){
        mysqli_query($conn,"update producttype set Type = '$type' where id = '$id'");
        redirect('Product.type.php');
    }
  

    //insert category
    if($msg=="" && $id <= 0){
        mysqli_query($conn,"insert into producttype (Type,status) 
        values('$type','1')");
        redirect('Product.type.php');
    }
   
   

} 
?>
         <form method="post" enctype='multipart/form-data'>
                 <h2>Manage Product Type</h2>
                <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" value="<?php echo $type ?>" placeholder="Name of product type" required/>
                </div>
              
                <button type="submit" name="submit">Submit</button>
                  <p class="msg"><?php echo $msg ?></p>
            </form>
  
  
<?php require('Bottom.inc.php') ?>