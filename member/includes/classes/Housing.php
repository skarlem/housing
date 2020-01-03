<?php
class Housing{
    var $memberid;

    function __construct($memberid){
        $this->memberid = $memberid;
    }

    function getHouseSelections(){
        $sql = "
        SELECT housing_detail.member_id,housing_detail.id,house_model.model_name,housing_detail.house_name,house_model.house_desc FROM `housing_detail` inner join house 
on house.id = housing_detail.house_id

inner join house_model on 
house_model.house_model_id = house.house_model_id

where housing_detail.member_id =  ".$this->memberid."";

        $query = tep_db_query($sql);
        
        $members =array();
        

		if (!$query) {
			echo "An error occurred.\n";
			exit;
		}
		else{
			while($info = tep_db_fetch_array($query)){
				$members[] = $info;
			}
		}       
		return $members;
    }

    function getAmountPaid($house_id){
        $sql ="SELECT sum(amount) as amount from user_payments where housing_detail_id = $house_id and status!='PENDING'";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['amount'];
    }

    function getHouses($subd_id){
        $sql = "SELECT h.terms as terms_id, h.house_model_id as id,h.model_name,h.house_desc,h.subdivision_id,s.subdivision_name,s.address 
        FROM `house_model`as h inner join subdivision as s on h.subdivision_id = s.id
        where h.subdivision_id = $subd_id
        ";

        $query = tep_db_query($sql);
        
        $members = array();
		if (!$query) {
			echo "An error occurred.\n";
			exit;
		}
		else{
			while($info = tep_db_fetch_array($query)){
				$members[] = $info;
			}
		}       
		return $members;
    }

    function getSubdivision(){
        $sql = "select * from subdivision";

        $query = tep_db_query($sql);
        
        $members = array();
		if (!$query) {
			echo "An error occurred.\n";
			exit;
		}
		else{
			while($info = tep_db_fetch_array($query)){
				$members[] = $info;
			}
		}       
		return $members;
    }


    function getImgPaths($house_id){
        $sql = "SELECT `id`, `house_id`, `img_path` FROM `house_img` WHERE `house_id`=".$house_id."";
        $query = tep_db_query($sql);
        
        $members = array();
		if (!$query) {
			echo "An error occurred.\n";
			exit;
		}
		else{
			while($info = tep_db_fetch_array($query)){
				$members[] = $info;
			}
		}       
		return $members;

    }


    function getTerms($arr){
        $Array = $arr;
        $storeArray= Array();
        for ($i = 0; $i < sizeof($Array); $i++){
            $storeArray[$i] = tep_db_query("SELECT * from terms WHERE id='$Array[$i]'");
            while($row = tep_db_fetch_array($storeArray[$i])){
                $storeArray[$i] =  $row;
            }
        }     
        return $storeArray;
    }

    function getPaymentScheme($terms_id){
        $sql = "select ps.payment_type as p_type_id,ps.p_range,ps.id,ps.terms_id,p.payment_type,ps.amount from payment_scheme as ps inner join payment as p on ps.payment_type = p.id
         where terms_id = $terms_id
        ";

        $query = tep_db_query($sql);
        
        $members = array();
		if (!$query) {
			echo "An error occurred.\n";
			exit;
		}
		else{
			while($info = tep_db_fetch_array($query)){
				$members[] = $info;
			}
		}       
		return $members;
    }


    function selectLot($lot,$house_id,$subd_id){
        $sql = "SELECT * from house";

        $query = tep_db_query($sql);

        $result = tep_db_fetch_array($query);

        if(count($result) > 0){
            return $house_id;
        }else{
            return false;
        }


    }

    function isHouseSelected($house_id,$lot,$block,$subd_id){
        $sql = 'SELECT hd.house_id,h.lot,h.block,h.subdivision_id,h.model_name,hd.house_name,hd.member_id,hd.terms_id,hd.member_id,h.house_desc 
        FROM `housing_detail` as hd inner join house as h on hd.house_id = h.id  where hd.house_id = "'.$house_id.'" and h.lot= "'.$lot.'" and h.block = "'.$block.'" and h.subdivision_id = "'.$subd_id.'"';

    $query = tep_db_query($sql);
            
    $members = array();
    if (!$query) {
        echo "An error occurred.\n";
        exit;
    }
    else{
        while($info = tep_db_fetch_array($query)){
            $members[] = $info;
        }
    }       
    return $members;

    }




    function selectBlock($block,$house_id,$subd_id){
        $sql = "SELECT * from house";

        $query = tep_db_query($sql);

        $result = tep_db_fetch_array($query);

        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    function insertSelectedHouse($member_id,$house_id,$house_name,$terms_id,$rate,$lot,$block){
        //    $id = $this->member_id;

        // $sql = 'INSERT INTO `ewallet_purchase_log`( purchased, amount, date, member_id) VALUES 
        // ("'.tep_db_input($item).'","'.tep_db_input($amount).'","'.tep_db_input($date).'","'.tep_db_input($memberid).'")';

        $sql = 'INSERT INTO `housing_detail`(`member_id`, `house_id`, `house_name`,`terms_id`,`rate`,`lot`,`block`) VALUES 
      ("'.tep_db_input($member_id).'","'.tep_db_input($house_id).'","'.tep_db_input($house_name).'","'.tep_db_input($terms_id).'","'.tep_db_input($rate).'","'.tep_db_input($lot).'","'.tep_db_input($block).'")';

        $query = tep_db_query($sql);

        return $query;
    }


    function getPayments(){
        $sql = "";

        $query = tep_db_query($sql);



        return $query;
    }

    function getLastId(){
        $sql ="SELECT id from housing_detail order by id desc limit 1";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['id'];
    }

    function getRate(){
        $sql ="SELECT rate from rate where status='active'";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['rate'];
    }

    function setPayments($due_date,$amount,$p_type_id,$member_id,$housing_detail_id){
        $sql = 'INSERT INTO `user_payments`(`p_type_id`, `due_date`, `amount`, `status`, `member_id`,`housing_detail_id`) 
        VALUES ("'.tep_db_input($p_type_id).'","'.tep_db_input($due_date).'","'.tep_db_input($amount).'","PENDING","'.tep_db_input($member_id).'","'.tep_db_input($housing_detail_id).'")';
        $query = tep_db_query($sql);
        return $query;
    }




    function getPaymentsHistory($housing_detail_id){
      $sql = "select up.id,p.payment_type,up.due_date,up.amount,up.date_paid,up.status,up.housing_detail_id from user_payments as up inner join payment as p
         on up.p_type_id = p.id where up.housing_detail_id = $housing_detail_id";
        $query = tep_db_query($sql);
                
        $members = array();
        if (!$query) {
            echo "An error occurred.\n";
            exit;
        }
        else{
            while($info = tep_db_fetch_array($query)){
                $members[] = $info;
            }
        }       
        return $members;

    }



    function getHPoints(){
        $sql ="SELECT points from h_points where member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['points'];
    }


    function updatePoints($amount){
        $sql = "UPDATE `h_points` SET `points`=`points`-".$amount." WHERE member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        return $query;
    }


    function insertToLogs($event){
        $sql = "INSERT INTO `system_logs`( `event`, `member_id`, `date`)   
        VALUES ('$event',$this->memberid,NOW())";
        
         $query = tep_db_query($sql);
        
         return $query;
        
    }

    function insertToWalletLogs($event){
        $sql = "INSERT INTO `system_logs`( `event`, `member_id`, `date`)   
        VALUES ('$event',$this->memberid,NOW())";
        
         $query = tep_db_query($sql);
        
         return $query;
        
    }

    function requestWithdrawal($amount){
        $sql = 'INSERT INTO `withdrawal`(`amount`, `status`, `date`, `member_id`) VALUES ("'.tep_db_input($amount).'","PENDING",NOW(),'.$this->memberid.')';

        $query = tep_db_query($sql);
        return $query;

    }

    function getWithdrawalRequests(){
        $sql = "SELECT `id`, `amount`, `status`, `date`, `member_id` FROM `withdrawal` WHERE member_id = ".$this->memberid."";
        $query = tep_db_query($sql);


        $history = array();
  
  
        while($row = tep_db_fetch_array($query)){
          $history[] =  $row;
        }
        return  $history;

    }

    function getWalletAmount(){
        $sql ="SELECT amount from commission_wallet where member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['amount'];
    }

    function getReceipientUsername($username){
        $sql = "select concat(member_fname,' ',member_lname) as member_name from member where member_username = '$username'";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['member_name'];

    }

    function transferWallet($to,$from,$amount){
        $sql_to = 'UPDATE `h_points` set points = points+'.tep_db_input($amount).'
         where member_id = (select member_id from member where member_username = "'.tep_db_input($to).'")';


         $sql_from = 'UPDATE `h_points` set points = points-'.tep_db_input($amount).'
         where member_id = (select member_id from member where member_username = "'.tep_db_input($from).'")';

        $query1 = tep_db_query($sql_from);
        if($query1){
           $query = tep_db_query($sql_to);
           if($query){
        //    echo 'wallet successfully updated';
            return  $query;
           }
         
        }
      
    }


    function insertTransferLog($to,$from,$amount){
        $date = date('Y/m/d H:i:s');
        $sql = 'INSERT INTO `h_points_transfer_log`( member_id_to, member_id_from, amount, date) VALUES 
        ((select member_id from member where member_username = "'.tep_db_input($to).'"),(select member_id from member where member_username = "'.tep_db_input($from).'"),"'.tep_db_input($amount).'","'.tep_db_input($date).'")';
  
  
        $query = tep_db_query($sql);
        if($query){
        //  echo 'wallet history successfully updated';
        }
        return  $query;
    }


    // function getTransferLogs()
    function getTransferLogs(){
        $sql = "SELECT e.id,concat(m.member_fname, ' ',m.member_lname) as sent_from,(select concat(member_fname, ' ',member_lname) as sent_to from member where member_id = e.member_id_to)as sent_to,
        e.amount,e.date from h_points_transfer_log as e inner join member as m on e.member_id_from = m.member_id where e.member_id_from =  ".$this->memberid."";
        $query = tep_db_query($sql); 
         
        
  
        $history = array();
  
  
        while($row = tep_db_fetch_array($query)){
          $history[] =  $row;
        }
        return  $history;
      }


    function insertWalletTransferLogs($to,$from,$amount){
        $date = date('Y/m/d H:i:s');
        $sql = 'INSERT INTO `ewallet_transfer_log`( member_id_to, member_id_from, amount, date) VALUES 
        ((select member_id from member where member_username = "'.tep_db_input($to).'"),(select member_id from member where member_username = "'.tep_db_input($from).'"),"'.tep_db_input($amount).'","'.tep_db_input($date).'")';
  
  
        $query = tep_db_query($sql);
        if($query){
        //  echo 'wallet history successfully updated';
        }
        return  $query;
      }
    
    function payHouse($house_id){
      // 
      $sql = "UPDATE `user_payments` SET `date_paid`=NOW(), `status`='PAID' WHERE id = ".$house_id."";
      $query = tep_db_query($sql);
      
      return $query;
    }




    function getTotalPayment(){
        $sql ="SELECT sum(amount) as amount from user_payments where  member_id = ".$this->memberid." and status!='PENDING'";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['amount'];
    }

    function getHouseNumber(){
        $sql ="SELECT count(*) as count from housing_detail where member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['count'];
    }


    function getHousingPayments($housing_id){

        $sql = "SELECT user_payments.id,user_payments.due_date,user_payments.date_paid,user_payments.amount,user_payments.status,user_payments.member_id,user_payments.housing_detail_id,payment.payment_type FROM `user_payments` 
        inner join payment on user_payments.p_type_id = payment.id where member_id = ".$this->memberid." and housing_detail_id = ".$housing_id."  and user_payments.status='PENDING' limit 15";
        $query = tep_db_query($sql);
                
        $members = array();
        if (!$query) {
            echo "An error occurred.\n";
            exit;
        }
        else{
            while($info = tep_db_fetch_array($query)){
                $members[] = $info;
            }
        }       
        return $members;
    }


    function updatePayment($house_id){

    }


    function getReferralCode(){
        $sql ="SELECT referral_code  from member where member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['referral_code'];
    }

    function getMemberId(){
        $sql ="SELECT member_id  from member where member_id = ".$this->memberid."";
        $query = tep_db_query($sql);
        
        $result = tep_db_fetch_array($query);
        return $result['member_id'];
    }
}


?>