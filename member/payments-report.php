<?php 
	include 'includes/inc.php';
	
	$page = 'housing payments report';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/payments-report.php';
	}else{
		include 'index.php';
	}
?> 