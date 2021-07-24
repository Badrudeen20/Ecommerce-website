<?php 
include('Function.inc.php');
 session_start();
 unset($_SESSION['ADMIN']);
 unset($_SESSION['ADMIN_NAME']);
 unset($_SESSION['ADMIN_ID']);
  redirect('Login.php');
?>