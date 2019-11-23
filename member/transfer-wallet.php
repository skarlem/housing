<?php 
	include 'includes/inc.php';
	
	$page = 'commission wallet';
	
	if($_SESSION['userid'] != ''){
		
		include THEME_FILE.'/transfer-wallet.php';
	}else{
		include 'index.php';
	}
?> 