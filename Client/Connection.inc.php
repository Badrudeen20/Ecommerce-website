<?php
session_start();
$server= "localhost";
$password = "";
$username="root";
$dbname = "ecm";

$conn = mysqli_connect($server,$username,$password,$dbname);
?>