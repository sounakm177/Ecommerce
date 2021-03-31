<?php
	require('header.inc.php');
	
	if(isset($_GET['type']) && $_GET['type']!='' && $_GET['type']=='status'){
		if(isset($_GET['oparation']) && $_GET['oparation']!=''){
			$oparation=get_value($conn,$_GET['oparation']);
			$id=get_value($conn,$_GET['id']);
			if($oparation=='active'){
				$status='1';
				$sql="update product set status='$status' where id='$id'";
				mysqli_query($conn,$sql);
				
			}else if($oparation=='deactive'){
				$status='0';
				$sql="update product set status='$status' where id='$id'";
				mysqli_query($conn,$sql);
				
			}else if($oparation=='delete'){
				
				$sql="select image from product where id='$id'";
				$row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
				if(isset($row['image']) && $row['image']!=''){
					$img_path=get_value($conn,$row['image']);
					
					if (file_exists($img_path)){
						unlink($img_path);
					}else{}	
				}
				$sql="delete from product where id='$id'";
				mysqli_query($conn,$sql);
				
			}else if($oparation=='best_on'){
				$best_seller='1';
				$sql="update product set best_seller='$best_seller' where id='$id'";
				mysqli_query($conn,$sql);
				
			}else if($oparation=='best_off'){
				$best_seller='0';
				$sql="update product set best_seller='$best_seller' where id='$id'";
				mysqli_query($conn,$sql);
				
			}else{
				?>
					<script>
						window.location.href='product.php';
					</script>
				<?php
				die();
			}
		}
	}
	
	
?>
<!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ALL ORDERS</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="order_master.php">Orders</a></li>
            </ol>
          </div>
		  
 <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ORDERS</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
						<th>ORDER ID</th>
                        <th>ORDER DATE</th>
                        <th>ADDRESS</th>
                        <th>PAYMENT TYPE</th>
                        <th>PAYMENT STATUS</th>
                        <th>ORDER STATUS</th>
                        <th>SHOW</th>
                        <th>EDIT</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
						<th>ORDER ID</th>
                        <th>ORDER DATE</th>
                        <th>ADDRESS</th>
                        <th>PAYMENT TYPE</th>
                        <th>PAYMENT STATUS</th>
                        <th>ORDER STATUS</th>
                        <th>SHOW</th>
                        <th>EDIT</th>
                      </tr>
                    </tfoot>
                    <tbody>
					<?php
						$sql="select * from orders order by id desc";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
							$order_status=$row['order_status'];
							$order_status_result=mysqli_query($conn,"select * from order_status where id='$order_status'");
							if(mysqli_num_rows($order_status_result)>0){
								$order_status_row=mysqli_fetch_assoc($order_status_result);
								$order_type=$order_status_row['name'];
							}else{
								$order_type="Alredy Delivered";
							}
							
					?>
					 <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['added_on']?></td>
                        <td><?php echo $row['first_address']?></td>
                        <td><?php echo $row['payment_type']?></td>
                        <td><?php echo $row['payment_status']?></td>
                        <td><?php echo $order_type ?></td>
                        <td><a class="btn btn-success" style="color:white;" href="show_order.php?id=<?php echo $row['id']?>">CLICK<i class="fas fa-mouse"></i></a></td>
                        <td><a class="btn btn-info" href="edit_order_status.php?id=<?php echo $row['id']?>">CLICK<i class="fas fa-mouse"></i></a></td>
                      </tr>
					<?php
						}
					?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
           </div>
          <!--Row-->
		  
		  
		 
<?php
	require('footer.inc.php');
?>