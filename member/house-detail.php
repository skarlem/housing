<?php 
	include 'includes/inc.php';
	
	$page = 'house detail';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/house-detail.php';
	}else{
		include 'index.php';
	}
?> 