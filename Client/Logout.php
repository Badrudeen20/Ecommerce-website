<?php 
include('Function.inc.php');
 session_start();
 unset($_SESSION['CUSTOMER']);
 unset($_SESSION['CUSTOMER_NAME']);
 unset($_SESSION['CUSTOMER_ID']);
  redirect('Login.php');
?>