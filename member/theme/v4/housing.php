<?php
include('layouts/header.php');
include('layouts/navbar.php');



if(isset($_POST['submit'])){
  $member_id = $userID;
  $house_id = tep_db_input($_POST['model']);
  $lot = tep_db_input($_POST['lot']);
  $block = tep_db_input($_POST['block']);
  $house_name = tep_db_input($_POST['house_name']);
  $terms_id = tep_db_input($_POST['terms']);
  $transaction = $housing->insertSelectedHouse($member_id,$house_id,$house_name,$terms_id);

  $house_detail_id =  $housing->getLastId();

  foreach($housing->getPaymentScheme($terms_id) as $selection){
    $id = $selection['id'];
    $payment_type = $selection['payment_type'];
    $range = $selection['p_range'];
    $amount = $selection['amount'];
    $p_type_id = $selection['p_type_id'];
    
  

    for($i=1; $i<=$range; $i++){
      $time = strtotime(date("Y/m/d"));
      $due_date = date("Y-m-d", strtotime("+$i month", $time));
      $housing->setPayments($due_date,$amount,$p_type_id,$member_id,$house_detail_id);
    }

} 
  if($transaction){
    $logs =  $housing->insertToLogs("Added house named ".$house_name);
     if($logs){
        echo '
        <script>
        Swal.fire({
          title: "Good Job!",
          text: "House Selected Successfully",
          type: "success",
        
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok"
        }).then((result) => {
          if (result.value) {
            window.location.href="housing.php";
          }
        })
        </script>
        '; 
     } 
 
  }
}




$subd_id = isset($_POST['subd']) ? $_POST['subd_id']: 1;


?>


<div class="content">
          <div class="container-fluid">

  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="col-sm-3">
                <div class="card-header card-header-success">
                    <h4 class="card-title">House Selection</h4>
                    
                </div>
            </div>
          
            <div class="card-body">

<div class="row">
  <div class="col-md-3">
<form action="" method="POST"> 


    <div class="form-group bmd-form-group">
        <label for="exampleFormControlSelect1">Select Subdivision </label>
        <select class="form-control selectpicker" name="subd_id"data-style="btn btn-link" id="exampleFormControlSelect1">
        <?php
                                
          foreach($housing->getSubdivision() as $term){
              $id = $term['id'];
              $desc = $term['subdivision_name'];
              echo '
              <option value="'.$id.'">'.$desc.'</option>
                                      
              ';
          } 
                                    
        ?>
        </select>
    </div>
    
<button type="submit" name="subd"class="btn btn-primary float-right">

Select Subdivision
</button> 
  </div>
  
</div>

</form>

<div class="row" style="background-image: url(<?php echo THEME_FILE?>assets/img/housing_slideshow/1.jpg); height: 500px; width: 100%; border: 1px solid black;">

<div class="col-lg-12" >


<?php 

if(isset($_POST['subd'])){


  foreach($housing->getHouses($subd_id) as $house){
    $id = $house['id'];
    $model_name = $house['model_name'];
    $address = $house['address'];
    $subdivision = $house['subdivision_name'];
    $lot = $house['lot'];
    $block = $house['block'];
    $terms_id = $house['terms_id'];
    $subdivision_id = $house['subdivision_id'];
   
    $string = $terms_id;
  
    $string = preg_replace('/\.$/', '', $string); 
    $array = explode(',', $string); 

?>
<div class="row">
<div class="col-md-3">

<p>Model Name:<?php echo $model_name?></p><p>Subdivision:<?php echo $subdivision?></p> <p>Address:<?php echo $address?></p>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $id?>">
  Select House Model <?php echo $id?>
</button> 
</div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">House Selection Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
      <div class="text-center">
      <div id="carouselExampleIndicators<?php echo $id?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators<?php echo $id?>" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators<?php echo $id?>" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators<?php echo $id?>" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/asd<?php echo $id?>.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/qwe<?php echo $id?>.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/zxc<?php echo $id?>.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators<?php echo $id?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators<?php echo $id?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
      </div>
      </div>
      <br>
        <form method="POST">
        <input type="hidden" id="subdivision_id<?php echo $id?>" value="<?php echo $subdivision_id ?>">
                    <div class="form-group bmd-form-group">
                      <label for="model" class="bmd-label-floating">Model </label>
                      <input type="text" class="form-control"  value="<?php echo $model_name?>" readonly>
                      <input type="hidden" class="form-control"  name="model" id="model<?php echo $id?>" value="<?php echo $id?>" readonly>
                    </div>
                    <div class="form-group bmd-form-group">
                      <label for="lot" class="bmd-label-floating">Lot Number</label>
                      <input type="number" class="form-control"  oninput="getLot(this.id)" name="lot" id="lot<?php echo $id?>"  required>
                    </div>

                    <div class="form-group bmd-form-group">
                      <label for="block" class="bmd-label-floating">Block Number</label>
                      <input type="number" class="form-control"  oninput="getLot(this.id)" name="block" id="block<?php echo $id?>" required>
                    </div>
                   

                    <div class="form-group bmd-form-group">
                    <label for="exampleFormControlSelect1">Terms To Pay </label>
                            <select class="form-control selectpicker" name="terms"data-style="btn btn-link" id="exampleFormControlSelect1" required>
                              <?php
                                foreach($housing->getTerms($array) as $term){
                                  $term_id = $term['id'];
                                  $desc = $term['terms_desc'];
                                  echo '
                                  <option value="'.$term_id.'">'.$desc.'</option>
                                  '; 
                                  }
                              ?>
                            </select>
                    </div>

                    <div class="form-group bmd-form-group">
                      <label for="house_name" class="bmd-label-floating">Name Your House</label>
                      <input type="text" class="form-control" name="house_name" id="house_name" required>
                    </div>

                    <div class="alert alert-danger" id="txtHint<?php echo $id?>" hidden>Sorry, but the lot and block is already taken. Please choose another lot and block.</div>
                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submit-btn" name="submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>       
       
       
<?php
  }
}
?>             

</div>
<!-- end col-lg-12 -->
<!-- 
<div class="col-lg-7">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/housing_slideshow/1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/housing_slideshow/2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/housing_slideshow/3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->



</div>

</div>
<!-- end row -->
               
                </div>
            </div>
        </div>
    </div>
  </div>
  
  
  </div>
</div>
  
  
  
  
<script>

var lot;
var block;
var house_id;
var subdivision_id;


function getLot(id){

  let gen_id = id.slice(-1);
  
 lot = document.getElementById('lot'+gen_id).value;
 block = document.getElementById('block'+gen_id).value;
 house_id = document.getElementById('model'+gen_id).value;
 subdivision_id = document.getElementById('subdivision_id'+gen_id).value;
 console.log('block is' + block);
 console.log('lot is' + lot);
 console.log('house_id is' + house_id);
 console.log('subdivision_id is' + subdivision_id);
 
  var array = [];
  array.push(lot);
  array.push(block);
  array.push(house_id);
  array.push(subdivision_id);


  console.log(array);
 setTimeout(function(){ 
   
   checkHouse(array,gen_id); 
   
   }, 2000);
}



function checkHouse(data,id){
  var xhr;
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
      xhr = new XMLHttpRequest();
  } else if (window.ActiveXObject) { // IE 8 and older
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }

    xhr.open("POST", "response.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
    xhr.send("house_data="+JSON.stringify(data));
    xhr.onreadystatechange = display_data;
    function display_data() {
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
     //  console.log('qweqwe'+xhr.responseText);
         
          if(xhr.responseText!=""){
            $("#txtHint"+id).attr("hidden", false);
           // document.getElementById("txtHint"+id).innerHTML = xhr.responseText;
           }else{
           $("#txtHint"+id).attr("hidden", true);
           }
         
       
       
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