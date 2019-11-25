<?php
// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', 'http://housing.oneheartwd.biz/'); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', 'https://housing.oneheartwd.biz/'); // eg, https://localhost - should not be empty for productive servers
  
  define('ENABLE_SSL', false); // secure webserver for checkout procedure?
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '');
  define('HTTPS_COOKIE_PATH', '');
  define('DIR_WS_HTTP_CATALOG', '');
  define('DIR_WS_HTTPS_CATALOG', ''); 
 
 // define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', dirname(__FILE__).'/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
  
  define('IMAGE_PATH', 'images/' );
  define('SITE_LOGO_PATH', IMAGE_PATH.'OneHeart.png' );


  define('CURRENT_THEME', 'v4');

  define('THEME_FILE', 'theme/'.CURRENT_THEME.'/');
  define('THEME', 'themes/'.CURRENT_THEME.'/');
  
  define('THEME_CSS', THEME.'/assets/css/');
  define('THEME_FONTS', THEME.'/assets/fonts/');
  define('THEME_JS', THEME.'/assets/js/');
  define('THEME_PLUGINS', THEME.'/assets/vendor/');
 
  define('VERSION', '1');



  // $host = "pogsnet07023.ipagemysql.com"; 
  // $user = "czarina";
  // $password = "94S8gh^d3LKuM0NSlQ";
  // $database = "oneheartbizf2"; 
  

	$host = "localhost";
		$user = "root";
		$password = "";
		$database = "housing";
  
    
// $host = 'pogsnet52040.ipagemysql.com';
// $user = '1h_gold_user';
// $database = '1h_gold';
// $password = '1hgold@1122';

  define('DB_SERVER', $host); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', $user);
  define('DB_SERVER_PASSWORD', $password);
  define('DB_DATABASE', $database);
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', ''); // leave empty '' for default handler or set to 'mysql'
  
  $OHhost = "pogsnet07023.ipagemysql.com";
  $OHuser = "dim_1heart";
  $OHpassword = "dimskie@123";
  $OHdatabase = "oneheart";
  
  define('DB_OHSERVER', $OHhost); // eg, localhost - should not be empty for productive servers
  define('DB_OHSERVER_USERNAME', $OHuser);
  define('DB_OHSERVER_PASSWORD', $OHpassword);
  define('DB_OHDATABASE', $OHdatabase); 
  

  
?>

<?php
	//require_once 'define.php';
	// include the database functions
	require(DIR_WS_FUNCTIONS . 'database.php');
	
	// make a connection to the database... now
	tep_db_connect() or die('Unable to connect to database server!');
?> 