<?php 
	include 'includes/inc.php';
	
	$page = 'housing';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/housing.php';
	}else{
		include 'index.php';
	}
?> 