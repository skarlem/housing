<?php
include('layouts/header.php');
include('layouts/navbar.php');

if(isset($_POST['update_profile'])){
  $memInfoDetails = array();
 
	$memInfoDetails['account_fname'] = (isset($_POST['fname']) && ($_POST['fname'] !== '') ) ? $_POST['fname'] : '';
	$memInfoDetails['account_lname'] = (isset($_POST['lname']) && ($_POST['lname'] !== '') ) ? $_POST['lname'] : '';
	$memInfoDetails['member_email'] = (isset($_POST['email']) && ($_POST['email'] !== '') ) ? $_POST['email'] : '';
	$memInfoDetails['address'] = (isset($_POST['address']) && ($_POST['address'] !== '') ) ? $_POST['address'] : '';
	$memInfoDetails['member_contactnum'] = (isset($_POST['contactnum']) && ($_POST['contactnum'] !== ''))? 
                      $_POST['contactnum'] : '';
                      
  $memInfoDetails = (object) $memInfoDetails;
		$success = $memberInfo->updateInfo($memInfoDetails);
				if($success){
          echo '
            <script>
            Swal.fire({
              title: "Good Job!",
              text: "Profile Update Successful",
              type: "success",
            
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Ok"
            }).then((result) => {
              if (result.value) {
                window.location.href="profile.php";
              }
            })
            </script>
          '; 
        }
				
}

?>


<div class="content">
          <div class="container-fluid">
  
  <div class="row">
<div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Edit Profile -
                    <small class="category">Complete your profile</small>
                  </h4>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Fist Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $memberInfo->memberDetails->member_fname;?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="lname"class="form-control" value="<?php echo $memberInfo->memberDetails->member_lname;?>">
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">

                    <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $memberInfo->memberDetails->member_email;?>">
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" name="address"class="form-control" value="<?php echo $memberInfo->memberDetails->member_location;?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                     
                     
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Contact Number</label>
                          <input type="text" name="contactnum" class="form-control"  value="<?php echo $memberInfo->memberDetails->member_contactnum;?>">
                        </div>
                      </div>
                     
                    </div>
                   
                    <button type="submit" name = "update_profile" class="btn btn-rose pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
  
<div class="col-md-4">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Change Password 
                    
                  </h4>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Old Password</label>
                          <input type="password" name="old_pass"class="form-control">
                        </div>
                      </div>
                     </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">New Password</label>
                          <input type="password" name="email" class="form-control">
                        </div>
                      </div>
                    
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Confirm New Password</label>
                          <input type="password" name="fname" class="form-control">
                        </div>
                      </div>
                    </div>
                   
                    <button type="submit" class="btn btn-rose pull-right">Change Password</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
  
            </div>
            </div>
  
            </div>

<?php
include('layouts/footer.php');
?>