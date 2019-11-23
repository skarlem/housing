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



   
   
   function getAvailableAcctcodetoActivate(){
	   $sql = "SELECT * FROM account_code WHERE member_id = '".$this->memberid."' AND account_type = 'paid'";
	   $query = tep_db_query($sql);
	   $result = tep_db_fetch_array($query);
	   
	   return $result['amount'];
   }
   
   function getFormattedMemberStatus(){
	   switch($this->memberDetails->member_status){
		   case 'blocked':
		   case 'inactive':
		   		$text =  '&nbsp;<span class="text-danger">'.$this->memberDetails->member_status.'</span>&nbsp;';
		   break;
		   
		   default:
		   		$text = '&nbsp;<span class="text-success">'.$this->memberDetails->member_status.'</span>&nbsp;';
		   break;
	   }
	  
	   return $text;
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
   
   function transferMemberCode($array){
	   $array = (object) $array;
	   
	   //validate member
	   if($this->memberDetails->member_username != $array->username)
	   		$member = $this->getMemberbyUsername($array->username);
	  
	  
	   if(($member)){
	   	   // validate amount to transfer
		   $codeInfo = $this->getMemberCodebyCodeId($array->accttypeid, $this->memberid);
		   if($codeInfo->amount >= $array->qty ){
		   	   $minusQty = $codeInfo->amount - $array->qty;
			   
			   //minus the transferred code qty from the giver
			   if($this->updateMemberCodeQty($array->accttypeid,$minusQty)){
				   
				   //add the transferred code to the username
				   
				   //if member type exists, then add the points else create one
				   $existingCode = $this->getMemberCodebyType($codeInfo->account_type, $member->member_id);
				   if($existingCode){
				   		// update member code
						$addedQty = $existingCode->amount + $array->qty;
						$updateMemberCode = $this->updateMemberCodeQty($existingCode->account_code_id, $addedQty);
						if($updateMemberCode){
							 
							  $logtext = 'Added '.$array->qty.' '.$codeInfo->account_type;
							  $logtext .=' accounts to member ID '.$member->member_id;
							  
							  insertLog($this->memberid, $logtext);
						  }
						 $logTransferCodes = array('from_member_id' => $this->memberid,
						  							'to_member_id' => $member->member_id,
													'transferred_acctcode_id' => $array->accttypeid,
													'recvd_acctcode_id' => $existingCode->account_code_id,
													'qty' => $array->qty);
						  return $this->logTransferCodes($logTransferCodes);
				   }else{
					   // create one
				   		$createMemberCode = $this->createMemberCode($member->member_id,$codeInfo->account_type,$array->qty);
						
						  if($createMemberCode){
							  $this->activateMemberStatus($member->member_id);
							  
							  $logtext = 'Added '.$array->qty.' '.$codeInfo->account_type;
							  $logtext .= 'accounts to member ID '.$member->member_id;
							  
							  insertLog($this->memberid, $logtext);
						  }
						  $logTransferCodes = array('from_member_id' => $this->memberid,
						  							'to_member_id' => $member->member_id,
													'transferred_acctcode_id' => $array->accttypeid,
													'recvd_acctcode_id' => $createMemberCode,
													'qty' => $array->qty);
						  return $this->logTransferCodes($logTransferCodes);
				   }
				  
			   } return false;
		   } return false;
	   }
	  
   }
   
   function updateInfo($array){
   	 $acctSql = 'UPDATE `member` SET member_fname = "'.tep_db_input($array->account_fname).'" ,
	 								member_lname = "'.tep_db_input($array->account_lname).'" ,
									member_email = "'.tep_db_input($array->member_email).'" ,	
									member_contactnum = "'.tep_db_input($array->member_contactnum).'" ,	
									member_location ="'.tep_db_input($array->address).'"
	  							
									WHERE member_id = "'.$this->memberid.'"';
	 
	  $acctsQuery = tep_db_query($acctSql);
	  if($acctsQuery){
		  $logtext = 'Profile is updated';
		  insertLog($this->memberid, $logtext);
	  }
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
   
   function updateOHInfo($member){
	    $member = (object) $member;
   		$sql = "UPDATE member SET ohpw = MD5('".tep_db_input($member->ohwp)."'), ohid = '".$member->ohid."'
				WHERE member_id = '".$this->memberid."'";
		
		$query = tep_db_query($sql);
		
		if($query){
		   $logtext = 'OH Information is updated';
		   insertLog($this->memberid, $logtext);
		}
		
		return  $query;
   }
   
   function getAvailableAccountType($acctType = 'free'){
	   
		$sql = "SELECT * FROM account_code WHERE member_id = '".$this->memberid."'
				AND amount > 0 AND account_type = '".$acctType."'";
		$query = tep_db_query($sql);
		$resultNum =  tep_db_num_rows($query);
	    
		if($resultNum == 1){
			$accts = tep_db_fetch_array($query);
			return (object) $accts;
		}
   }
   
   function getMemberCodebyCodeId($codeId, $memberId){
	   $sql = "SELECT * FROM account_code WHERE account_code_id = '".$codeId."' AND member_id = '".$memberId."'";
				
		$query = tep_db_query($sql);
		$resultNum =  tep_db_num_rows($query);
	    
		if($resultNum == 1){
			$code = tep_db_fetch_array($query);
			return (object) $code;
		}
   }
   function getMemberCodebyType($type, $memberId){
	   $sql = "SELECT * FROM account_code WHERE account_type = '".$type."' AND member_id = '".$memberId."'";
				
		$query = tep_db_query($sql);
		$resultNum =  tep_db_num_rows($query);
	    
		if($resultNum == 1){
			$code = tep_db_fetch_array($query);
			return (object) $code;
		}
   }
   
   function updateMemberCodeQty($codeId,$qty){
	   $sql = "UPDATE account_code SET amount = '".$qty."' WHERE account_code_id = '".$codeId."' ";
	   $query = tep_db_query($sql);
	   return $query;
   }
 
   function createMemberCode($memberId,$type,$qty){
	  
	   $sql = "INSERT INTO account_code(member_id, account_type, amount) VALUES('".$memberId."','".$type."','".$qty."' )";
	   $query = tep_db_query($sql);
	   return tep_db_insert_id();
   }
   
   function activateMemberStatus($memberId){
	    $sql = "SELECT member_status FROM member WHERE member_id = '".$memberId."'";
		$query = tep_db_query($sql);
		$result = tep_db_fetch_array($query);
		
		$status = $result['member_status']; 
		
		if($status != 'active'){
			$sql = "UPDATE member SET member_status = 'active' WHERE member_id = '".$memberId."' ";
		   $query = tep_db_query($sql);
		   if($query){
			  $logtext = 'Membership status is activated.';
			  insertLog($memberId, $logtext);
		  }
		  return $query;
		}else return true;
   }
   
    function logTransferCodes($array){
	   $array = (object) $array;
	   $sql = "INSERT INTO transfer_codes(from_member_id, to_member_id, transferred_acctcode_id, recvd_acctcode_id, qty) 
	   			VALUES( '".$array->from_member_id."',
						'".$array->to_member_id."', 
						'".$array->transferred_acctcode_id."', 
						'".$array->recvd_acctcode_id."', 
						'".$array->qty."' )";
	   $query = tep_db_query($sql);
	   return $query;
   }
   function viewLogTransferCodes(){
	  $sql = "SELECT * FROM  `transfer_codes` WHERE from_member_id = '".$this->memberid."' ORDER BY date DESC" ;  
	  //$sql .= "ORDER BY date DESC";
	  $query = tep_db_query($sql);
	  $result = array();

	  while($row = tep_db_fetch_array($query)){
		  $sent2Name = $this->getMemberbyId($row['to_member_id'])->member_fname.' '
		  				.$this->getMemberbyId($row['to_member_id'])->member_lname;
		  $getCodeType = $this->getMemberCodebyCodeId($row['transferred_acctcode_id'], $this->memberid)->account_type;				
		  $result[] = (object) array('sent_to' => $sent2Name, 'date' => $row['date'], 'acctType' => $getCodeType,
		  							'qty' => $row['qty']);
	  }
	  return  $result;
   }
   function getwithdrawMode($id){
	  $sql = 'SELECT * FROM  `withdraw` WHERE id = '.$id;
	  $query = tep_db_query($sql);
	  $result = $row = tep_db_fetch_array($query);

	   return (object)$result;
   }
   function getEarning($type = 'binary'){
	  switch($type){
		  case 1:
		  	$type = 'binary';
		  break;
		  case 2:
		  	$type = 'unilevel';
		  break;
		  case 3:
			$type = 'referral';
		  break;
		  case 4:
			$type = 'pairing';
		  break;
		   case 5:
			$type = 'mktg_allowance';
		  break;
	  }
	  $sql = 'SELECT * FROM  `total_earnings` WHERE member_id = '.$this->memberid;
	  $query = tep_db_query($sql);
	  $result = $row = tep_db_fetch_array($query);
		$total = 0;
		$total += $result[$type];
	   return $total;
   }
  
   function requestWithdraw($array){
	  $array = (object) $array;
	  if($this->getEarning($array->type) >= $array->amount  ){
	  	   
		  $sql = 'INSERT INTO withdraw(member_id, withdraw_mode_id, withdraw_amount, withdraw_status, truemoney) ';
		  $sql.= 'VALUES("'.$this->memberid.'", "'.$array->type.'", "'.$array->amount.'", "PENDING", 
		  			"'.$array->truemoney.'")';
		   
		  $query = tep_db_query($sql);
		  
		  if($query){
			  
			  switch($array->type){
				  case 1:
					$type = 'binary';
					$type_str = 'binary';
				  break;
				  case 2:
					$type = 'unilevel';
					$type_str = 'unilevel';
				  break;
				  case 3:
					$type = 'referral';
					$type_str = 'referral';
				  break;
				  case 4:
					$type = 'pairing';
					$type_str = 'pairing';
				  break;
				   case 5:
					$type = 'mktg_allowance';
					$type_str = 'marketing allowance';
				  break;
			  }
			  $logtext = 'Requested '.$array->amount.' '.$type_str.' withdrawal.';
			  insertLog($this->memberid, $logtext);
			  
			  $totalEarnings = $this->getEarning($array->type) - $array->amount;
			//  echo 'left - '.$totalEarnings;
			  echo '
			  <script>
			  Swal.fire({
				title: "Good Job!",
				text: "Withdraw Request Successfull!",
				type: "success",
				
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok"
				}).then((result) => {
				if (result.value) {
				  window.location.href="withdraw.php";
				}
				
				})
			  </script>
			  '; 
			  $sql_ = 'UPDATE total_earnings SET `'.$type.'` = '.$totalEarnings.' WHERE member_id = '.$this->memberid;
			  $query_ = tep_db_query($sql_);
		  } 
		   return $query;
	  } else{  return false;}
   }
   
   function viewWithdrawal(){
	  $sql = 'SELECT * FROM  `withdraw` WHERE member_id = '.$this->memberid.' ORDER BY withdraw_date DESC';  
	 
	  $query = tep_db_query($sql);
	  $result = array();

	  while($row = tep_db_fetch_array($query)){
		  $type = '';
		  switch($row['withdraw_mode_id']){
			  case 1:
				$type = 'binary';
			  break;
			  case 2:
				$type = 'unilevel';
			  break;
			  case 3:
				$type = 'referral';
			  break;
			  case 4:
				$type = 'pairing';
			  break;
			   case 5:
				$type = 'mktg_allowance';
			  break;
		  }
		  $row['mode'] = $type;
		  $result[] = (object) $row;
	  }
	  
	  return $result;
   }
   
   function viewMktgAllWithdrawal(){
	  $sql = 'SELECT * FROM  `withdraw` WHERE member_id = '.$this->memberid.' AND withdraw_mode_id = 5
	  		 ORDER BY withdraw_date DESC';  
	 
	  $query = tep_db_query($sql);
	  $result = array();

	  while($row = tep_db_fetch_array($query)){
		  $row['mode'] = 'Marketing Allowance';
		  $result[] = (object) $row;
	  }
	  
	  return $result;
   } 

   function viewRedeem($redeemStatus = ''){
	  $sql = 'SELECT * FROM  `redeem` WHERE member_id = '.$this->memberid;  
	  if($redeemStatus != ''){
		   $sql .= ' AND redeem_status = "'.$redeemStatus.'" ';  
	  }
	  $sql .= ' ORDER BY redeem_date DESC';  
	  
	  $query = tep_db_query($sql);
	  $result = array();

	  while($row = tep_db_fetch_array($query)){
		  switch($row['redeem_type_id']){
			  case 3:
				$type = 'referral';
			  break;
			  case 4:
				$type = 'pairing';
			  break;
		  }
		  $row['mode'] = $type;
		  $result[] = (object) $row;
	  }
	  
	  return $result;
   }
   function requestRedeemBonus($array){
	  $array = (object) $array;
	  //echo '<pre>'; print_r($array); echo '</pre>';
	  if($this->getEarning($array->type) >= $array->amount  ){
	  	   
		  /*$sql = 'SELECT outlet FROM outlet_code WHERE member_id = '.$this->memberid.' ';
		  $sql .= 'AND ';*/
		  
		  $sql = 'INSERT INTO redeem(member_id, redeem_type_id, redeem_qty, redeem_status, outlet_code) ';
		  $sql.= 'VALUES("'.$this->memberid.'", "'.$array->type.'", "'.$array->amount.'", "PENDING", 
		  			"'.$array->outletcode.'")';
		  
		  $query = tep_db_query($sql);
		  
		  if($query){
			  
			  switch($array->type){
				  case 3:
					$type = 'referral';
				  break;
				  case 4:
					$type = 'pairing';
				  break;
			  }
			  $logtext = 'Requested '.$array->amount.' '.$type.' bunos redeem.';
			  insertLog($this->memberid, $logtext);
			  
			  $totalEarnings = $this->getEarning($array->type) - $array->amount;
			  
			  
			  $sql = 'UPDATE total_earnings SET `'.$type.'` = '.$totalEarnings.' WHERE member_id = '.$this->memberid;
			 $query = tep_db_query($sql);
		  }
		  
		   return $query;
	  } else{  return false;}
   }
   
   function getTotalAccts($status = -1){
	   $sql = 'SELECT count(*) as total FROM  `account` 
	   			WHERE member_id = '.$this->memberid;  
	   if($status != -1){
		   $sql .= ' AND account_status = '.$status;
	   }
	  $query = tep_db_query($sql);
	  $result = tep_db_fetch_array($query);
	  return $result['total'];
   }
   
   function getRedeemOutlet(){
	   if($this->memberDetails->redeem_outlet_access == 1){
	   		  $sql    = 'SELECT * FROM redeem_outlet WHERE member_id = "'.$this->memberid.'"'; 
			  $query  = tep_db_query($sql);
			  $result = array();
		
			  while($row = tep_db_fetch_array($query)){
				  switch($row['redeem_type_id']){
					  case 3:
						$type = 'referral';
					  break;
					  case 4:
						$type = 'pairing';
					  break;
				  }
				  $row['mode'] = $type;
				  $result[] = (object) $row;
			  }
			  return $result;
	   }return false;
   }
   
   
   function getLogs(){
   	  $sql    = 'SELECT * FROM general_logs WHERE member_id = "'.$this->memberid.'" AND
	  				 MONTH(date) = MONTH(CURRENT_DATE())
					AND YEAR(date) = YEAR(CURRENT_DATE()) ORDER BY date DESC'; 
	  $query  = tep_db_query($sql);
	  $result = array();

	  while($row = tep_db_fetch_array($query)){
		  $result[] = (object) $row;
	  }
	  return $result;
   }
   
   function checkifWithdrawalisRequested($type){
	    $mode = 0;
		switch($type){
			case 'mktg_allowance':
				$mode = 5;
			break;
		}
	    $withdraw_sql = tep_db_query( "SELECT * FROM withdraw WHERE DAY(`withdraw_date`) = DAY(CURRENT_DATE()) 
	   					AND withdraw_status = 'PENDING' AND withdraw_mode_id = '".$mode."' 
						AND  member_id = '".$this->memberid."'");
		if(tep_db_num_rows($withdraw_sql) > 0){
			return true;
		} return false;
   }
   
   
}
?>