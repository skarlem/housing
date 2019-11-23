<?php session_start();
	
	// start the timer for the page parse time log
	  define('PAGE_PARSE_START_TIME', microtime());
	
	// set the level of error reporting
	 //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
							
	
	  if (defined('E_DEPRECATED')) {
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	  }
	// check support for register_globals
	  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
		exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.'); 
	  }
	
	// load server configuration parameters
		/*if(file_exists ('configure-local.php')){
			echo 'sadasdasd';
			include('configure-local.php');
		}else
	  	include('configure.php');*/
	include('configure.php');
	  if (strlen(DB_SERVER) < 1) {
		if (is_dir('install')) {
		  header('Location: install/index.php');
		}
	  }
	   $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

	// set php_self in the local scope
	  $req = parse_url($HTTP_SERVER_VARS['SCRIPT_NAME']);
	  $PHP_SELF = substr($req['path'], ($request_type == 'NONSSL') ? strlen(DIR_WS_HTTP_CATALOG) : strlen(DIR_WS_HTTPS_CATALOG));
	
	  if ($request_type == 'NONSSL') {
		define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
	  } else { 
		define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
	  }
	
	
	require(DIR_WS_FUNCTIONS . 'sessions.php');
	require(DIR_WS_FUNCTIONS . 'general.php');
	require(DIR_WS_CLASSES . 'Member.php');
	require(DIR_WS_CLASSES . 'Accounts.php');
	require(DIR_WS_CLASSES . 'oneHeart.php');
	
	
	
  // set SID once, even if empty
  $SID = (defined('SID') ? SID : '');
  
  	if($_SESSION['userid'] != ''){
		//echo '<pre style="display:none;" class="inc">'; print_r($_SESSION); echo '</pre>';
		$memberInfo = new Member($_SESSION['userid']);
		$accounts = new Accounts($_SESSION['userid']);
		$userFirstName ='';
		$userID = $_SESSION['userid'];
	}
	
?>