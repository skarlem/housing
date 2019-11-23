<?php
include('layouts/header.php');
include('layouts/navbar.php');



?>


<div class="content">
          <div class="container-fluid">
  
  <div class="row">
<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">account_balance</i>
                  </div>
                  <h4 class="card-title">House Detail 
                 
                  </h4>
                </div>
                <div class="card-body">
                  





                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo THEME_FILE?>assets/img/house_img/3.jpg" alt="Third slide">
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
                    </div>

<br>

                    <p>Model Name:House Model 1</p><p>Subdivision:Illuminati Subdivision</p> <p>Address:Brgy. 1437, Earth 615</p>


                    




                </div>
              </div>
            </div>
  
  
            </div>
            </div>
  
            </div>

<?php
include('layouts/footer.php');
?>