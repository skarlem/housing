<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="success" data-image="<?php echo THEME_FILE?>assets/img/sidebar-3.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->

       <div class="logo">
        <a href="#" class="simple-text logo-normal">
          OneHeart Housing
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php  echo $page === 'dashboard' ? 'active': '';?>">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-item <?php  echo $page === 'profile' ? 'active': '';?>">
            <a class="nav-link" href="profile.php">
              <i class="material-icons"> account_circle </i>
              <p>Profile</p>
            </a>
          </li>
          
        

          <li class="nav-item <?php  echo $page === 'housing' ? 'active': '';?>">
            <a class="nav-link" href="housing.php">
              <i class="material-icons">location_ons</i>
              <p>House Selection</p>
            </a>
          </li>
         
          <li class="nav-item <?php  echo $page === 'payments' ? 'active': '';?>">
            <a class="nav-link" href="payments.php">
              <i class="material-icons">content_paste</i>
              <p>Payments</p>
            </a>
          </li>

          <li class="nav-item <?php  echo $page === 'housing payments report' ? 'active': '';?>">
            <a class="nav-link" href="payments-report.php">
              <i class="material-icons">list</i>
              <p>Housing Payments Report</p>
            </a>
          </li>

          <li class="nav-item <?php  echo $page === 'commission wallet' ? 'active': '';?>">
            <a class="nav-link" href="transfer-wallet.php">
              <i class="material-icons">compare_arrows</i>
              <p>Wallet Points</p>
            </a>
          </li>
          

          
          
          <li class="nav-item ">
            <a class="nav-link" href="logout.php">
              <i class="material-icons">lock-open</i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>



    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href=""><?php echo ucwords($page);?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
           
             <!-- dropdown for settings--> 
             <li class="nav-item dropdown">
                <a class="nav-link"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">settings</i>
                  
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                
                  
                  
                </div>
              </li>
             <!-- /dropdown for settings--> 

             
             
            </ul>
          </div>
        </div>

 
      </nav>