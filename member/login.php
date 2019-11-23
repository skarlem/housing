<?php 
if(session_status() == PHP_SESSION_ACTIVE) {
	session_unset();
session_destroy(); }

if (session_status() == PHP_SESSION_NONE) { session_start(); ob_start(); }
date_default_timezone_set('Asia/Manila');


?>
	


<!DOCTYPE html>
<html lang="en">
	<?php include("head.php"); ?>

	<!--
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/_smarty/boxed_background/1.jpg"
	-->
	<body class="smoothscroll enable-animation">
				<?php
			
			

?>
<?php
$msg_result = "";
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	} 
	
	$date = date('F d, Y h:i:s A');
	
include('config.php');




if (!$conn) {
    header( "Location: maintenance.html" );

}
if (file_exists("index.html") == 1) { header( "Location: index.html" );  }



//////////Login
// if (isset($_POST['username'])) {
// 	$username = mysqli_real_escape_string($conn,$_POST['username']);
// 	$password= mysqli_real_escape_string($conn,$_POST['password']);
// 	$password = md5($password);
	
// 	$sql="SELECT * FROM member WHERE member_username='$username' and member_pw='$password' and member_status!='blocked'";
// 	$result= mysqli_query($conn,$sql);
//     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
//     $count = mysqli_num_rows($result);



// if($count == 1) {
// 	$msg_result = "success";
// 	$msg = "Login Accepted!";
// 	//$result2= mysqli_query($conn,$sql);
				
//    //while ($row2 = mysqli_fetch_array($result2)){  $GLOBALS['username'] = $row2['username'];  }
   
//    						$sql="SELECT * FROM member WHERE member_username='$username'";
// 							$result= mysqli_query($conn,$sql);
					
// 						while ($row = mysqli_fetch_array($result)){ 
// 						$mem_id = $row['member_id'];
// 						} 	
   
	
// 	$sql56="INSERT INTO login_logs SET member_ip='$ip', member_username='$username', member_id='$mem_id', login_date='$date'";
//     mysqli_query($conn,$sql56);
	
// 	//$_SESSION["aguila"]["username"] = $username;
// 	$_SESSION['username'] = $username;
// 	 $_SESSION['CREATED'] = time();
// 	header( "Location: member/" ); 
// 	// header( "Location: member/maintenance.html" );

	
	
// }
// else  { 
// $msg_result = "fail";
// 	     $msg = "Invalid username or password! Please login appropriately.";
// }
	
// 		//mysqli_free_result($result);
	
// //end login
// }








try{
    // session_start();
    // $_SESSION['login'];
    // if($_SESSION['login']==true){
    //     header( "Location: login.php" ); 
    // }
    // else{  
        if(isset($_POST['username'])){
            $username = mysqli_real_escape_string($conn,$_POST['username']);
            $password= mysqli_real_escape_string($conn,$_POST['password']);
            
            $sql="SELECT * FROM member WHERE member_username='$username' and member_pw='$password' and member_status!='blocked'";
            $result= mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);
    
            if($count === 1){
                
                header( "Location: index.php" ); 
            }
            else{
				echo'Error Login';
				echo$username;
				echo$password;

			}
		}
    
    //     }
    // }
}catch(Exception $e){
   

}



if (isset($_GET['denied'])) {
	
  $msg_result = "fail";
  $msg = "Access Denied! Please login appropriately.";
	
}
//$_SESSION['username'] 
if (isset($_GET['logout'])) {
	
	session_unset();
    session_destroy();

    $msg_result = "success";
	$msg = "Logout Successful! Thank you. :)";
}
if (isset($_GET['timeout'])) {
	
	session_unset();
    session_destroy();

    $msg_result = "fail";
	$msg = "Time out: Reauthentication Needed.";
}
	mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8" />
        <title>Member</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="OneHeart Wellness Distribution - your partner to success and health" name="description" />
        <meta content="oneheart" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="favicon/favicon.ico">

        <!-- C3 charts css -->
        <link href="css/c3.min.css" rel="stylesheet" type="text/css"  />

        <!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <link href="css/bootstrap-select.min.css" rel="stylesheet" />


        <script src="js/modernizr.min.js"></script>

    </head>
<body>
    	<div id="wrapper">    	
            <div class="content-page" style="margin-left: 0px !important; ">
       
                <div class="content">
           
                    <div class="container-fluid">
                
                
                	   <div class="col-xl-6 center-page">
                            <div class="card">
                                <div class="card-body">
                            	   <div class="text-center">
                                        <h4 class="header-title m-t-0">Welcome to OneHeart Wellness Super Page</h4>
                                        <p>Please login below.</p>
                                    </div>
                                    <form name="login" method="POST">
                                    <div class="form-group">
                                        <label for="email">Username<span class="text-danger">*</span></label>
                                        <input type="text" name="username" required="" placeholder="Enter Username" class="form-control" id="username">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input name="password" type="password" placeholder="Enter password" required="" class="form-control">
                                    </div>

                                      
                                    </div>
                                    
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Loginasdasdasd
                                        </button>
                                        <div class="form-group">
                                            <button>asdasd</button>
					                    </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                 	</div>
                    
                    
                    
                </div>
                
            </div>
        </div>
 </div>

</body>
</html>

<div class="modal fade bd-example-modal-sm" id="error"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      Error! Invalid Username or Password
    </div>
  </div>
</div>