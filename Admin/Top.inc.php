<?php 
include('Connection.inc.php');
include('Function.inc.php');
if(!isset($_SESSION['ADMIN'])){
   redirect('Login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css' />   
     <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <div class="navigation ">
            <ul>
             
                <li>
                    <a href="Index.php"> 
                      <span class="icon"><i class="fi-rr-basketball"></i></span>
                      <span class="title"><h2>Brand</h2></span>
                    </a>   
                </li>      
           

           
                <li>
                    <a href="Index.php">
                      <span class="icon"><i class="fi-rr-home"></i></span>
                      <span class="title">Dashborad</span>
                    </a>  
                </li>
           
                <li>
                   <a href="Customer.php"> 
                      <span class="icon"><i class="fi-rr-users"></i></span>
                      <span class="title">Customer</span>
                    </a> 
                </li>

                <li>
                  <a href="Order.php">
                     <span class="icon"><i class="fi-rr-square"></i></span>
                     <span class="title">Orders</span>
                  </a>  
                </li>

                <li>
                   <a href="Category.php">
                     <span class="icon"><i class="fi-rr-apps"></i></span>
                     <span class="title">Category</span>
                  </a> 
                </li>

                <li>
                   <a href="Product.type.php">
                     <span class="icon"><i class="fi-rr-apps"></i></span>
                     <span class="title">Type</span>
                  </a> 
                </li>

                <li>
                    <a href="Product.php">
                      <span class="icon"><i class="fi-rr-box"></i></span>
                      <span class="title">Product</span>
                    </a>  
                </li>
              
                <li>
                    <a href="Logout.php">
                      <span class="icon"><i class="fi-rr-box"></i></span>
                      <span class="title">Logout</span>
                    </a>  
                </li>
                
            </ul>
            <div class="close" onclick="closeMenu()">
                <i class="fi-rr-cross"></i>
            </div>
        </div>
   
        <div class="main">


            <div class="topbar">
                <div class="toggle"><i onclick="toggleMenu()" class="fi-rr-menu-burger"></i></div>
               
                <div class="search">
                    <label for="search">
                        <input type="text" placeholder="Search" />
                    </label>
                </div>    
                
                <div class="user">
                        <a href="#"><img src="./img/profile.jpg" /></a>
                </div>
            </div>