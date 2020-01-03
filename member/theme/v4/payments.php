<?php
include('layouts/header.php');
include('layouts/navbar.php');



// if(isset($_POST['house'])){
//     $house_id = $_POST['house'];
   
// }else{
//     $house_id = 1;
// }

$house_detail_id = isset($_POST['house']) ? $_POST['house'] : 0;


if(isset($_POST['payment'])){
  $payment_id = $_POST['payment_id'];
  $amount = $_POST['amount'];
  $payment = $housing->payHouse($payment_id);
  $event = $_POST['event'];

  if($payment){
    $housing->updatePoints($amount);
   $logs =  $housing->insertToLogs("Paid ".$event." for an amount of ".$amount);
      if($logs){
        echo '
        <script>
        Swal.fire({
          title: "Good Job!",
          text: "Payment Successfull",
          type: "success",
        
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok"
        }).then((result) => {
          if (result.value) {
            window.location.href="payments.php";
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
    <div class="col-md-12">
        <div class="card">
            <div class="col-sm-3">
                <div class="card-header card-header-success">
                    <h4 class="card-title">House Payment 
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
        <select class="form-control selectpicker"required name="house"data-style="btn btn-link" id="exampleFormControlSelect1">
     <option value=""></option>
        <?php
                                
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
                         <th>
                         ID
                         </th>
                          <th > 
                            Payment Type
                          </th>

                          <th>
                            Due Date
                          </th>
                       
                          <th>
                            Amount
                          </th>
                       
                          <th>
                            Status
                          </th> 
                         <th>
                            Option
                         </th> 
                         
                        </thead>
                        <tbody>
                          
                        <?php
                     
                        foreach($housing->getHousingPayments($house_detail_id) as $row ){
                              $id = $row['id'];
                              $payment_type = $row['payment_type'];
                              $due_date = $row['due_date'];
                              $amount = $row['amount'];
                              $status = $row['status'];
                              $date_paid = $row['date_paid'];


                              $old_date_timestamp = strtotime($due_date);
                              $new_date = date(' F d, Y', $old_date_timestamp);   
                          ?>
                          <tr>
                          <td>  <?php echo $id ?></td>
                              
                              <td><?php echo $payment_type ?></td>
                              <td><?php echo $new_date ?></td>
                             
                              <td><?php echo $amount ?></td>
                              <td><?php echo $status?></td>

                              <td>
                              <?php if(strtoupper ( $status )!='PENDING'){
                                }else{
                                ?>
                              <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?php echo $id ?>">Pay</button></td>
                                <?php }?>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">House <?php ?> Payment  </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST">
                                      <input type="hidden" name="payment_id" id="payment_id" value="<?php echo $id?>">
                                                  
                                                <input type="hidden" name="amount" value="<?php echo $amount;?>">
                                                <input type="hidden" name="event" value="<?php echo $payment_type." #".$id;?>">
                                      <div class="alert alert-info">Are you sure you want to pay this payment for <?php echo $new_date?>?</div>
                                              
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                      <button type="submit" name="payment"class="btn btn-primary" id="submit-btn" name="submit">Yes</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>       
         <?php                   
                             
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
  
  
  <script>
  $('#amount').val($('#payment_type').val());
  $('#payment_type').on('change', function(e){
//   console.log(this.value,
//               this.options[this.selectedIndex].value,
//               $(this).find("option:selected").val(),);

              $('#amount').val(this.value);

              console.log( $('#payment_type').val());
});
  
  </script>
  
  
  <script>
 
  


$("#house").change(function(){
// e.preventDefault();
// var house=$(this).val();
// $.ajax({
//    type: 'post',
//    data: house,
//    success: function(result) {
//         console.log(house);
//    }
// });
checkHouse($(this).val());
});
  
  

function checkHouse(data){
  var xhr;
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
      xhr = new XMLHttpRequest();
  } else if (window.ActiveXObject) { // IE 8 and older
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }

    xhr.open("POST", "payments.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
    xhr.send("house="+data);
    xhr.onreadystatechange = display_data;
    function display_data() {
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
        //alert(xhr.responseText);	   
        $("#txtHint").attr("hidden", false);
      //  document.getElementById("txtHint").innerHTML = xhr.responseText;
        } else {
          alert('There was a problem with the request.');
        }
      }
  }
}

  </script>
  

  


<?php
include('layouts/footer.php');
?>