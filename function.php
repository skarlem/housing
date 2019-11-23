<?php 
function generateRandomString1($length = 15) {
    $characters1 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength1 = strlen($characters1);
    $randomString1 = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
    }
    return $randomString1;
}

function insertToReferral($conn,$refferedby_id,$last_id){
  
    
       
        $sql_referral = "INSERT INTO `referral`(`referred_member_id`, `referredby_member_id`) VALUES ('".$last_id."', '".$refferedby_id."')";
        if ($conn->query($sql_referral) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql_referral . "<br>" . $conn->error;
      }
}
function defaultReferral($conn,$refferedby_id,$last_id){
   
    $sql_referral = "INSERT INTO `referral`(`referred_member_id`, `referredby_member_id`) VALUES ('".$last_id."', '".$refferedby_id."')";
    if ($conn->query($sql_referral) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getMasterId($conn){
    $sql = "SELECT member_id from member where member_id = 1";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['member_id'];
}


function getReferrerName($conn,$member_id,$ref_code){
    $sql = "SELECT concat(member_fname,' ',member_lname) as name from member where member_id ='".$member_id."' and referral_code = '".$ref_code."'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['name'];
}

function getDefaultRefer($conn){
    $sql = "SELECT concat(member_fname,' ',member_lname) as name from member where member_id =1";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['name'];
}

function createHPoints($conn,$last_id){
    $sql_referral = "INSERT INTO `h_points`(`member_id`) VALUES ('".$last_id."')";
    if ($conn->query($sql_referral) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


function createWallet($conn,$last_id){
    $sql_referral = "INSERT INTO `commission_wallet`(`member_id`) VALUES ('".$last_id."')";
    if ($conn->query($sql_referral) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
	
	
?>