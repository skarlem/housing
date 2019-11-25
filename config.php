<?php 
	$host = "localhost"; 
	$user = "root";
	$password = "";
	$database = "housing"; 
  



    
$mysqli = new mysqli($host, $user, $password, $database);
$conn = mysqli_connect($host, $user, $password, $database);
error_reporting(E_ALL ^ E_WARNING); 

?>