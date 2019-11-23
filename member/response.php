<?php
include 'config.php';


if(isset($_POST['get_owner'])){
     $username = $_POST['get_owner'];
    // $recipient = $housing->getReceipientUsername($username);

    // echo $recipient;

    $sql = "select concat(member_fname,' ',member_lname) as member_name from member where member_username = '$username'";
    $result = mysqli_query($conn,$sql);
    
    $row = mysqli_fetch_array($result);
    if($row >0){
        echo 'Owner is '.$row[0];
    }
}


if(isset($_POST['house_data'])){
    $arr=json_decode($_POST['house_data']);
    

  
    $lot = $arr[0];
    $block = $arr[1];
    $house_id=$arr[2];
    $subd_id = $arr[3];  
    
  //  print_r($arr);
 //echo $lot." <-lot ".$block."<- block ".$house_id."<-house_id ".$subd_id."<-subd_id";

    $sql = 'SELECT hd.house_id,
    h.lot,
    h.block,
    h.subdivision_id,
    h.model_name,
    hd.house_name,
    hd.member_id,
    h.terms_id,
    hd.member_id,
    h.house_desc 
     
    FROM `housing_detail` as hd inner join house as h on hd.house_id = h.id  where hd.house_id = "'.$house_id.'" and h.lot= "'.$lot.'" and h.block = "'.$block.'" and h.subdivision_id = "'.$subd_id.'"';

    $result = mysqli_query($conn,$sql);
        
    $row = mysqli_fetch_array($result);
   
    if(!empty($row)){
        echo 'asdasd';
    }else{
       
    }


     // print_r($result);
  }


?>