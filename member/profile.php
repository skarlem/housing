<?php 
	include 'includes/inc.php';
	
	$page = 'profile';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/profile.php';
	}else{
		include 'index.php';
	}
?> 