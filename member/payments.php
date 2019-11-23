<?php 
	include 'includes/inc.php';
	
	$page = 'payments';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/payments.php';
	}else{
		include 'index.php';
	}
?> 