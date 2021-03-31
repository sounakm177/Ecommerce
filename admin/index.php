<?php
	require('header.inc.php');
	$count=0;
	$month_price='0';
	$sales='0';
	$new_user='0';
	
	$month_result=mysqli_query($conn,"select * from orders order by id desc");
	if(mysqli_num_rows($month_result)>0){
		while($row=mysqli_fetch_assoc($month_result)){
			$count++;
			$month_price=$month_price+$row['total_price'];
			if($count==30){
				break;
			}
		}
	}
	
	$sales_result=mysqli_query($conn,"select * from orders_detail order by id desc");
	if(mysqli_num_rows($sales_result)>0){
		while($row=mysqli_fetch_assoc($sales_result)){
			$count++;
			$sales=$sales+$row['qty'];
		}
	}
	
	$new_user_result=mysqli_query($conn,"select * from users order by id desc");
	if(mysqli_num_rows($new_user_result)>0){
		while($row=mysqli_fetch_assoc($new_user_result)){
			$count++;
			$new_user++;
			if($count==30){
				break;
			}
		}
	}
?>

  <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $month_price?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                        <span>Since last 30 Day</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sales?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span>Since last years</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $new_user?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-21 col-lg-12 mb-12">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="order_master.php">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						
						$sql="select * from orders order by id desc limit 6";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
							$order_status=$row['order_status'];
							$order_status_result=mysqli_query($conn,"select * from order_status where id='$order_status'");
							$order_id=$row['id'];
							if(mysqli_num_rows($order_status_result)>0){
								$order_status_row=mysqli_fetch_assoc($order_status_result);
								$order_type=$order_status_row['name'];
							}else{
								$order_type="Alredy Delivered";
							}
					?>
					 <tr>
                        <td><?php echo $order_id?></td>
                        <td><?php echo $row['payment_type']?></td>
                        <td><?php echo $row['payment_status']?></td>
                        <td><?php echo $order_type ?></td>
                       </tr>
					<?php
						}
					?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
         </div>
 

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

<?php
	require('footer.inc.php');
?>