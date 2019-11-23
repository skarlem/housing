<?php /*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
include 'includes/inc.php';
	

	
	
	$username = (isset($_POST['username']) && ($_POST['username'] !== '') ) ? $_POST['username'] : '';
	$password = (isset($_POST['password']) && ($_POST['password'] !== '') ) ? md5($_POST['password']) : '';
	
	$customer_info_query = tep_db_query("select * from member where 
								member_username = '".$username."' and member_pw = ('".$password."') ");
    $customer_info = tep_db_fetch_array($customer_info_query);
	
	if($username != '' && $password != ''){
		//echo '<pre>'; print_r($customer_info); echo '</pre>';
		$_SESSION['userid'] = $customer_info['member_id'];
		//set up cookie
		setcookie("user", $username, time() + (86400 * 30)); 
		setcookie("pass", $username, time() + (86400 * 30)); 
	}
	
	

	if(isset($_POST['submit'])){
		// if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
		// 	$secret = '6LcmVa0UAAAAAJ4NVjd83cRXGWzGKbekEoTVcfvC';
			
		//   $url= 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response'];
	
		//   $arrContextOptions=array(
		// 		"ssl"=>array(
		// 			  "verify_peer"=>false,
		// 			  "verify_peer_name"=>false,
		// 		  ),
		// 	  );  
		  
		//   $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
					
		//   //  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		// 	$responseData = json_decode($response);
		// 	if($responseData->success){
				if($_SESSION['userid'] != ''){ 
					
					/*echo "<script type='text/javascript'>window.location.href='{https://www.oneheartwd.biz/member/dashboard.php}'</script>";*/
							 
								if(empty($memberInfo))
									$memberInfo = new Member($_SESSION['userid']);
								// if(empty($accounts))
								// 	$accounts = new Accounts($_SESSION['userid']);
								
								include THEME_FILE.'/dashboard.php'; 
								
								
						}
						else{ 
							
								include THEME_FILE.'/login.php';
								echo '
								<script>
								Swal.fire({
								type: "error",
								title: "Oops...", 
								text: "Invalid username or password!",
								footer: ""
								})
								</script>
								'; 
						}
			}
	// 		else{
	// 			include_once THEME_FILE.'/login.php';
	// 			echo '
	// 				<script>
	// 				Swal.fire({
	// 				  type: "error",
	// 				  title: "Oops...",
	// 				  text: "Please check the captcha",
	// 				  footer: ""
	// 				})
	// 				</script>
	// 				';
	// 		}
	// 	}else{
	// 		include_once THEME_FILE.'/login.php';
	// 		echo '
	// 				<script>
	// 				Swal.fire({
	// 				  type: "error",
	// 				  title: "Oops...",
	// 				  text: "Please check the captcha",
	// 				  footer: ""
	// 				})
	// 				</script>
	// 				';
	// 	}

	// }
	else{
		include THEME_FILE.'/login.php'; 
	}
	

	
			
	 
	
?> 