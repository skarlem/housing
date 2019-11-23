<?php


	//  $host = "pogsnet07023.ipagemysql.com"; 
  	//  $user = "czarina";
  	//  $password = "94S8gh^d3LKuM0NSlQ";
  	//  $database = "oneheartbizf2"; 
	

	$host = "localhost"; 
	$user = "root";
	$password = "";
	$database = "housing";

 
global $conn;

$mysqli = new mysqli($host, $user, $password, $database);
$conn = mysqli_connect($host, $user, $password, $database);

?>