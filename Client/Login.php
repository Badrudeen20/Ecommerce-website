<?php 
 include('Connection.inc.php');
 include('Function.inc.php');
 if(isset($_SESSION['CUSTOMER'])){
    redirect('Home.php');
}

$msg = "";

if(isset($_POST['submit'])){
     $email = $_POST['email'];
     $password = $_POST['password'];
      $user_res =  mysqli_query($conn,"select * from customer where email = '$email' and password ='$password'");
      if(mysqli_num_rows($user_res) > 0){
           $user_row = mysqli_fetch_assoc($user_res);
           $_SESSION['CUSTOMER'] = 'yes';
           $_SESSION['CUSTOMER_NAME'] = $user_row['name'];
           $_SESSION['CUSTOMER_ID'] = $user_row['id'];
            redirect('Home.php');
      }else{
          $msg = "Invalid Email!";
      }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css" />

</head>
<body>
<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
		
		<form class="form" method="post">
			<input type="email" name="email" placeholder="Enter  Email">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="submit" id="login-button">Login</button>
		</form>
         <p><?php echo $msg ?></p>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
</body>
</html>