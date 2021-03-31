<?php
	require('header.inc.php');
	$order_status_name='sdfsdf';
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		$id=get_value($conn,$_GET['id']);
		$check_sql="select * from orders where id='$id'";
		$check_result=mysqli_query($conn,$check_sql);
		if(mysqli_num_rows($check_result)>0){
			$order_id=$id;
			$row=mysqli_fetch_assoc($check_result);
			$order_status=$row['order_status'];
			$order_status_sql="select * from order_status where id='$order_status'";
			$order_status_result=mysqli_query($conn,$order_status_sql);
			if(mysqli_num_rows($order_status_result)>0){
				$order_row=mysqli_fetch_assoc($order_status_result);
				$order_status_name=$order_row['name'];
			}
		}else{
			?>
				<script>
					window.location.href='order_master.php';
				</script>
			<?php
			die();
		}
	}else{
			?>
				<script>
					window.location.href='index.php';
				</script>
			<?php
			die();
	}
	
	//updata order status 
	if(isset($_POST['submit'])){
		if(isset($_POST['order_status']) && $_POST['order_status']!=''){
			$order_status=get_value($conn,$_POST['order_status']);
			$check_sql="select * from order_status where id='$order_status'";
			$check_result=mysqli_query($conn,$check_sql);
			if(mysqli_num_rows($check_result)>0){
				$update_sql="update orders set order_status='$order_status' where id='$order_id'";
				if(mysqli_query($conn,$update_sql)){
					?>
					<script>
						window.location.href='order_master.php';
					</script>
					<?php
					die();
				}else{
					?>
					<script>
						window.location.href='edit_order_status.php';
					</script>
					<?php
					die();
				}
			}else{
				?>
					<script>
						alert("Don't Oversmart !! If you do agine then your A/c will be deleted.");
						window.location.href='index.php';
					</script>
				<?php
				die();
			}
		}else{
			?>
				<script>
					window.location.href='edit_order_status.php';
				</script>
			<?php
			die();
		}
	}
	
?>
	<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Change Order Status</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="order_master.php">Order</a></li>
           </ol>
		</div>
		  <!-- Form Basic -->
              <div class="card mb-4 col-lg-8 offset-lg-2 mb-5 ">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Menage Order Status</h6>
                </div>
                <div class="card-body">
                  <form method='post'>
                    <div class="form-group">
                     <label for="Categories" class=" form-control-label">Order Status</label>
									
									<select class="form-control" name="order_status">
										<option>Select Status</option>
										<?php
										
											$result=mysqli_query($conn,"select * from order_status");
											
											while($row=mysqli_fetch_assoc($result)){
												if($row['name']==$order_status_name){
													echo "<option selected value=".$row['id'].">".$row['name']."</option>";
												}else{
													echo "<option value=".$row['id'].">".$row['name']."</option>";
												}
											}
										?>
									</select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form>
				  <span style="color:red;"></span>
                </div>
              </div>
	
<?php
	require('footer.inc.php');
?>

