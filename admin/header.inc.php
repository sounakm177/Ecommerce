<?php
	require('connection.inc.php');
	require('function.inc.php');
	$admin_name='';
	if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
		$admin_name=$_SESSION['ADMIN_USERNAME'];
	}else{
		?>
		<script>
			window.location.href='login.php';
		</script>
		<?php
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">S Admin</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
	   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
         <i class="fab fa-product-hunt"></i>
          <span>PRODUCT ITEMS</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ITEMS</h6>
            <a class="collapse-item" href="categories.php">Categories</a>
            <a class="collapse-item" href="add_categories.php">Manage Categories</a>
            <a class="collapse-item" href="product.php">PRODUCT</a>
            <a class="collapse-item" href="add_product.php">Manage Product</a> 
          </div>
        </div>
      </li>
		
	  <li class="nav-item">
        <a class="nav-link" href="order_master.php">
        <i class="fas fa-angle-double-right"></i>
          <span>Order Master</span>
        </a>
      </li>
		
	  <li class="nav-item">
        <a class="nav-link" href="contact_us.php">
          <i class="far fa-address-book"></i>
          <span>Contact Us</span>
        </a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="users.php">
         <i class="fas fa-users"></i>
          <span>User Master</span>
        </a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="banner.php">
         <i class="fas fa-sliders-h"></i>
          <span>Banner Customize</span>
        </a>
      </li>
	  
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
	    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
         
          <ul class="navbar-nav ml-auto">
           
             
            <div class="topbar-divider d-none d-sm-block"></div>
            
			<li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $admin_name?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
		