<?php
include('layouts/header.php');
?>
<body class="off-canvas-sidebar">
  <!-- Extra details for Live View on GitHub Pages -->

  <!-- Navbar -->
<?php include('nav.php'); ?>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('images/bedroom2.jpeg'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="" action="">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-rose text-center">
                  <h4 class="card-title">Login</h4>

                </div>
                <div class="card-body ">
                  <p class="card-description text-center">Always remember your login information</p>

                  <form action="" method="POST">

                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                  </span>
                  <span class="bmd-form-group">

                  </span>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" name="password"class="form-control" placeholder="Password"  required>
                    </div>
                  </span>
                </div>
                <div class="card-footer justify-content-center">
                    <button type="submit" name="login"class="btn btn-rose btn-link btn-lg">Lets Go</button>
              
                </div>
                </form>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php 
include('layouts/footer.php');


      ?>