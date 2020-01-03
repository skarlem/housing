<?php
include('layouts/header.php');
include('layouts/navbar.php');





if(isset($_POST['submit-transfer'])){

  $to = $_POST['transfer_to'];
  $from = $_POST['transfer_from'];
  $amount = $_POST['transfer_amount'];

  $transferFund = $housing->transferWallet($to,$from,$amount);
  if($transferFund){
     $log = $housing->insertTransferLog($to,$from,$amount);
    echo '
              <script>
              Swal.fire({
                title: "Good Job!",
                text: "Wallet Fund Transfer Successfull",
                type: "success",
               
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ok"
              }).then((result) => {
                if (result.value) {
                  window.location.href="dashboard.php";
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
    <div class="col-md-3">
        <div class="card">

            <div class="card-header card-header-success">
                <h4 class="card-title">H Points</h4>
                
            </div>

            <div class="card-body">
            <?php echo $housing->getHPoints() !=0 ?  $housing->getHPoints() : 0.00 ;?>
          
                </div>

            </div>
        </div>

        <div class="col-md-3">
        <div class="card">

            <div class="card-header card-header-success">
                <h4 class="card-title">Total Number of Your House</h4>
                
            </div>

            <div class="card-body">
              <?php echo  $housing->getHouseNumber(); ?>
                </div>

            </div>
        </div>

        <div class="col-md-3">
        <div class="card">

            <div class="card-header card-header-success">
                <h4 class="card-title">Total H-Point Paid</h4>
                
            </div>

            <div class="card-body">
              <?php echo $housing->getTotalPayment()!=0 ?  $housing->getTotalPayment() : 0.00 ;?>
                </div>

            </div>
        </div>

        <div class="col-md-3">
        <div class="card">

            <div class="card-header card-header-success">
                <h4 class="card-title">Commission Wallet</h4>
                
            </div>

            <div class="card-body">
              <?php echo $housing->getWalletAmount()!=0 ?  $housing->getWalletAmount() : 0.00 ;?>
                </div>

            </div>
        </div>

    </div>



<div class="row">

 <div class="col-md-3">
 
  <div class="card">
    <div class="card-header card-header-primary">
         <h4 class="card-title">Referral Link</h4>
    </div>
    <div class="card-body">

    <div class="form-group form-file-upload form-file-multiple">
    <!-- <input type="hidden" multiple="" id="myInput"class="inputFileHidden" value="http://localhost/housing/register.php"> -->
    <div class="input-group">
        <input type="text" class="form-control inputFileVisible"  id="myInput" 
        value="http://Housing.oneheartwd.biz/register.php?id=<?php echo $housing->getMemberId();?>&ref_code=<?php echo $housing->getReferralCode();?>"placeholder="http://Housing.oneheartwd.biz/register.php">
        <span class="input-group-btn">
            <button type="button" class="btn btn-fab btn-round btn-primary" >
                <i class="material-icons">attach_file</i>
            </button>
        </span>
    </div>
  </div>

    <button class="btn btn-primary btn-link" onclick="myFunction()">Click to Copy</button>
    </div>
  </div>
 </div>

 <div class="col-md-3">
 
  <div class="card">
    <div class="card-header card-header-primary">
         <h4 class="card-title">Transfer H-Points</h4>
    </div>
    <div class="card-body">

    <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#transfer-fund-modal"> Transfer Points<i class="fas fa-fw fa-comments-dollar"></i> </button>
  </div>
 </div>

</div>
</div>


    <div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Your Houses</h4>
                
            </div>

            <div class="card-body">
              
            <div class="card-body">
            <div class="dataTable_wrapper" style="margin:20px;">
                    <div class="table-responsive">
                      <table class="table table-striped compact nowrap fixed" cellspacing="0"  id="dataTables-example" style="width:100%;">
                        <thead class=" text-primary">
                         
                          <th > 
                          Your House Name
                          </th>

                          <th>
                          House Model Name
                          </th>
                         
                          <th>
                           Total Amount Paid
                          </th>
                       
                          <th>
                            House Description
                          </th> 
                          
                         
                        </thead>
                        <tbody>
                          
                        <?php
                        foreach($housing->getHouseSelections() as $house){
                                $id = $house['id'];
                                $model_model = $house['model_name'];
                                $house_name= $house['house_name'];
                                $house_desc = $house['house_desc'];


                                echo '
                                <tr>
                                <td>'.$house_name.'</td>
                                <td>'.$model_model.'</td>
                                <td>
                                    '.$housing->getAmountPaid($id).'
                                </td>
                                <td>'.$house_desc.'</td>
                                </tr>
                                ';
                        }
                        ?>  
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                        
            </div>

            </div>

            </div>
        </div>
    
    
    </div>


  
    <div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">H-Points Transfer History</h4>
                
            </div>

            <div class="card-body">
              
            <div class="card-body">
            <div class="dataTable_wrapper" style="margin:20px;">
                    <div class="table-responsive">
                      <table class="table table-striped compact nowrap fixed" cellspacing="0"  id="dataTables-example" style="width:100%;">
                        <thead class=" text-primary">
                      
                          <th > 
                          ID
                          </th>

                          <th>
                          Date
                          </th>
                         
                          <th>
                          Amount
                          </th>
                       
                          <th>
                          From
                          </th> 
                          <th>

                          To

                          </th>
                          
                         
                        </thead>
                        <tbody>
                          
                        <?php
                        foreach($housing->getTransferLogs() as $house){

                         
                                $id = $house['id'];
                                $date = $house['date'];
                                $from= $house['sent_from'];
                                $to = $house['sent_to'];
                                $amount = $house['amount'];


                                $old_date_timestamp = strtotime($date);
                                $new_date = date(' F d, Y', $old_date_timestamp);   
                                echo '
                                <tr>
                                <td>'.$id.'</td>
                                <td>'.$new_date.'</td>
                                <td>'.$amount.'</td>
                                <td>'.$from.'</td>
                                <td>'.$to.'</td>
                                </tr>
                                ';
                        }
                        ?>  
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                        
            </div>

            </div>

            </div>
        </div>
    
    
    </div>
  


  
  </div>
</div>
  
  
<!-- Modal -->
<div class="modal fade" id="transfer-fund-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Transfer Fund</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method=POST>

       <div class="form-group bmd-form-group">
            <label for="transfer_amount" class="bmd-label-floating">Amount to Transfer</label>
           <input type="text" class="form-control" name="transfer_amount" id="transfer_amount" required>
       </div>

       <div class="form-group bmd-form-group">
            <label for="transfer_amount" class="bmd-label-floating"Recipient>Recipient</label>
           <input type="text" class="form-control" name="transfer_to" id="transfer_to" oninput="getUsername(this.value)"required>
       </div>

      
       

         
          <input type="hidden" name="transfer_from" value="<?php echo $memberInfo->memberDetails->member_username;?>">
          <div class="alert alert-info" role="alert" id="imongsendan" hidden>
     <small> </small>
  </div>
  
            
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="submit_btn" name="submit-transfer" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
  

  
  <script>
  
  function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
    Swal.fire({
    position: 'top-middle',
    icon: 'success',
    title: 'Linked Copied Successfully',
    showConfirmButton: false,
    timer: 1500
  })
}



function getUsername(data){

var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}


     xhr.open("POST", "response.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
     xhr.send("get_owner="+data);
	 xhr.onreadystatechange = display_data;
   console.log(data);
	function display_data() {
	 if (xhr.readyState == 4) {
      if (xhr.status == 200) {
       //alert(xhr.responseText);	   
       $("#imongsendan").attr("hidden", false);
       console.log(xhr.responseText);
	  document.getElementById("imongsendan").innerHTML = xhr.responseText;
      } else {
       // alert('There was a problem with the request.');
      }
     }
	}
}
  </script>


<?php
include('layouts/footer.php');
?>