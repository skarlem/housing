<?php
include('layouts/header.php');
include('layouts/navbar.php');


 $house_detail_id = isset($_POST['house']) ? $_POST['house'] : 0;

?>


<div class="content">
          <div class="container-fluid">

  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="col-sm-3">
                <div class="card-header card-header-success">
                    <h4 class="card-title">House Payment Report
                    <?php //print_r($housing->getPaymentsHistory($house_detail_id));?>
                     </h4>
                   
                </div>
            </div>
          
            <div class="card-body">

            <div class="row">
  <div class="col-md-3">
<form action="" method="POST"> 


    <div class="form-group bmd-form-group">
        <label for="exampleFormControlSelect1">Select House </label>
        <select class="form-control selectpicker" required name="house"data-style="btn btn-link" id="exampleFormControlSelect1">
        <option value="" ></option>
        <?php
                               /// print_r(getHouseSelections());
          foreach($housing->getHouseSelections() as $house){
              $id = $house['id'];
              $desc = $house['model_name'];
              echo '
              <option value="'.$id.'">'.$desc.'</option>
                                      
              ';
          } 
                                    
        ?>
        </select>
    </div>
    
<button type="submit" name="houses"class="btn btn-primary float-right">

Select House
</button> 
  </div>
  
</div>

</form>
            <div class="dataTable_wrapper" style="margin:20px;">
                    <div class="table-responsive">
                      <table class="table table-striped compact nowrap fixed" cellspacing="0"  id="dataTables-example" style="width:100%;">
                        <thead class=" text-primary">
                         
                          <th > 
                            Payment Type
                          </th>

                          <th>
                            Due Date
                          </th>
                         <th>
                         Date Paid
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
                     
                        foreach($housing->getPaymentsHistory($house_detail_id) as $row ){
                              $id = $row['id'];
                              $payment_type = $row['payment_type'];
                              $due_date = $row['due_date'];
                              $amount = $row['amount'];
                              $status = $row['status'];
                              $date_paid = $row['date_paid'];


                              $old_date_timestamp = strtotime($due_date);
                              $new_date = date('l, F d Y', $old_date_timestamp);  
                              
                              
                              $old_date_timestamp1 = strtotime($date_paid);
                              $new_date1 = date('l, F d Y', $old_date_timestamp1);

                              if($date_paid===' '){
                                  echo 'asdasd';
                              }
                          echo'
                          <tr>
                              
                              <td>'.$payment_type.'</td>
                              <td>'.$new_date.'</td>
                              <td>'.$date_paid.'</td> 
                              <td>'.$amount.'</td>
                              <td>'.$status.'</td>
                            
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
  
  
  
  
  
  
  


<?php
include('layouts/footer.php');
?>