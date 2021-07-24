<?php 
include('Connection.inc.php');
include('Function.inc.php');
$cart = 0;
$userid = 0;
if(isset($_SESSION['CUSTOMER'])){
    $userid = $_SESSION['CUSTOMER_ID'];
    $userid = $_SESSION['CUSTOMER_ID'];
    $cartsnum  =    mysqli_query($conn,"select id from cart where userid = '$userid'");
   // $customername =  mysqli_query($conn,"select name from customer where id = '$userid'");
    $cart = mysqli_num_rows($cartsnum);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/keen-slider@5.5.0/keen-slider.min.css"
  />
  <link rel="stylesheet"  href="css/styles.css" />
  <link rel="stylesheet" href="css/carousel.css"/>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="Home.php"><img src="../images/Brand.jpg" /></a>
        </div>
        <ul id="nav-menu">
          <?php
           $cateory_res = mysqli_query($conn,"select * from categories where status = 1");
           while($cateory_row = mysqli_fetch_assoc($cateory_res)){?>
                <li><a href="Product.php?id=<?php echo $cateory_row['id'] ?>"><?php echo $cateory_row['Category'] ?></a></li>
            
          <?php } ?>
           
            <?php if(isset($_SESSION['CUSTOMER'])){ ?>
            <li><a href="Logout.php">Logout</a></li>
             <?php } ?>   
            
        </ul>
        <?php if(isset($_SESSION['CUSTOMER'])){ ?>
            <a href="#"><span class="ion-android-social-user"></span></a>
            
         <?php }else{ ?>
            <a href="Login.php" class="login">Login</a>  
         <?php }?>   
        <!---->
        <?php if(isset($_SESSION['CUSTOMER'])){ ?>
          <a href="Cart.php" class="bag">
            <span class="ion-bag"></span>
            <span class="count"  id="cart"><?php echo $cart ?></span>
         </a>
        <?php  }else{ ?>
          <a href="Login.php" class="bag">
            <span class="ion-bag"></span>
            <span class="count"><?php echo $cart ?></span>
         </a>
        <?php  } ?>
        <span class="ion-navicon-round"></span>
    </nav>