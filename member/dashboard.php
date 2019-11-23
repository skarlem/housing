<?php 
	include 'includes/inc.php';
	
	$page = 'dashboard';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/dashboard.php';
	}else{
		include 'index.php';
	}
?> 