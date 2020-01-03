<?php
class Member{
	public $memberid;
	public $memberDetails;
	
   public function __construct($memberid){
       $this->memberid = $memberid;
	   $infoStr = 'SELECT * FROM  `member` where member_id = '.$this->memberid; 
	  
	   $infoQuery = tep_db_query($infoStr);
	   $info = tep_db_fetch_array($infoQuery);
	   
	//     $Possql = "SELECT description FROM position WHERE position_id = '".$info['set_position']."'";
 
	// 	$Posquery = tep_db_query($Possql);
	// 	$Posresult = tep_db_fetch_array($Posquery);
	   
	//    $info['position_description'] = $Posresult['description'];
	   $this->memberDetails = (object)$info;
   }



   
   
   function getMemberbyUsername($username){
   	   
	   $infoStr = 'SELECT * FROM  `member` where member_username = "'.$username.'"'; 
	   $infoQuery = tep_db_query($infoStr);
	   $info = tep_db_fetch_array($infoQuery);
	   
	   return (object) $info;
   }
   function getMemberbyId($id){
   	   
	   $infoStr = 'SELECT * FROM  `member` where member_id = "'.$id.'"'; 
	   $infoQuery = tep_db_query($infoStr);
	   $info = tep_db_fetch_array($infoQuery);
	   
	   return (object) $info;
   }
   
    
   function updateInfo($array){
   	 $acctSql = 'UPDATE `member` SET member_fname = "'.tep_db_input($array->account_fname).'" ,
	 								member_lname = "'.tep_db_input($array->account_lname).'" ,
									member_email = "'.tep_db_input($array->member_email).'" ,	
									member_contactnum = "'.tep_db_input($array->member_contactnum).'" ,	
									member_location ="'.tep_db_input($array->address).'"
	  							
									WHERE member_id = "'.$this->memberid.'"';
	 
	  $acctsQuery = tep_db_query($acctSql);
	 
	  return  $acctsQuery;
   }
   
   function changePw($pw){
	   
   		$sql = "SELECT * FROM member WHERE member_id = '".$this->memberid."' 
					AND member_pw = MD5('".tep_db_input($pw->oldpw)."')";
					
		$query = tep_db_query($sql); 
		$resultNum =  tep_db_num_rows($query);
	    if($resultNum == 1){
			$sql = "UPDATE member SET member_pw = MD5('".tep_db_input($pw->newpw)."') 
					WHERE member_id = '".$this->memberid."'";
			
			$query = tep_db_query($sql);
			
			if($query){
			   $logtext = 'Password is updated';
			   insertLog($this->memberid, $logtext);
		  	}
			
			return  $query;
		} else return false;
   }
   
   
   
}
?>