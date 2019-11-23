<?php
include('layouts/header.php');
include('layouts/navbar.php');

if(isset($_POST['withdraw'])){
  $amount = $_POST['withdraw_amount'];
  $request = $housing->requestWithdrawal($amount);
  $event = "Requested to withdraw ".$amount." from commission wallet";
  if($request){
      $log = $housing->insertToLogs($event);

      if($log){
        echo '
        <script>
        Swal.fire({
          title: "Good Job!",
          text: "Withdrawal Request Successfull",
          type: "success",
        
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok"
        }).then((result) => {
          if (result.value) {
            window.location.href="transfer-wallet.php";
          }
        })
        </script>
      '; 
      }
  }

}
?>


<div class="content">
          <div class="container-fluid">
  
  
          <div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Request Withdrawal</h4>
                
            </div>

              <div class="card-body">
                <form action="" method="POST">
                <div class="col-md-8">
                <div class="form-group bmd-form-group">
        <label for="exampleFormControlSelect1">Select Amount </label>
        <select class="form-control selectpicker" name="withdraw_amount"data-style="btn btn-link" id="exampleFormControlSelect1" required>
                    <option value=""></option>
                    <option value="1000">1000</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                    <option value="2500">2500</option>
                    <option value="3000">3000</option>
       
        </select>
    </div>
               
                </div>
                  <button type="submit" name="withdraw" class="btn btn-primary btn-round float-right" >Submit Request</button>        
              </div>
              
              </form>
            </div>

            </div>
        </div>
    
    
    </div>

          <div class="row">
        <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Commission Wallet Requests</h4>
                
            </div>

            <div class="card-body">
              
            <div class="card-body">
            <div class="dataTable_wrapper" style="margin:20px;">
                    <div class="table-responsive">
                      <table class="table table-striped compact nowrap fixed" cellspacing="0"  id="dataTables-example" style="width:100%;">
                        <thead class=" text-primary">
                         
                          <th > 
                        Date Requested
                          </th>

                          <th>
                         Amount
                          </th>
                         
                          <th>
                          Status
                          </th>
                       
                         
                          
                         
                        </thead>
                        <tbody>
                          
                        <?php
                        foreach($housing->getWithdrawalRequests() as $row){
                            $date = $row['date'];
                            $amount = $row['amount'];
                            $status = $row['status'];

                            $old_date_timestamp = strtotime($date);
                            $new_date = date(' F d, Y', $old_date_timestamp);   


                                echo '
                                <tr>
                                <td>'.$new_date.'</td>
                                <td>'.$amount.'</td>
                                <td>'.$status.'</td>
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
  


<?php
include('layouts/footer.php');
?>