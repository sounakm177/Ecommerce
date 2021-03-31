<?php
	require('header.inc.php');	
	if(isset($_GET['id']) && $_GET['id']!=''){
		$id=get_value($conn,$_GET['id']);
		$check_result=mysqli_query($conn,"select * from orders_detail where order_id='$id'");
		if(mysqli_num_rows($check_result)>0){
			$order_id=$id;
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
				window.location.href='order_master.php';
			</script>
		<?php
		die();
	}
?>

  <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="order_master.php">orders</a></li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ORDER DETAILS</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$product_id=array();
						$qty=array();
						$total_price=0;
						
						$result=mysqli_query($conn,"select * from orders_detail where order_id='$order_id'");
						while($row=mysqli_fetch_assoc($result)){
							$product_id[]=$row['product_id'];
							$qty[]=$row['qty'];
						}
						
						for($i=0; $i<count($product_id); $i++){
							$id=$product_id[$i];
							$product_qty=$qty[$i];
							$product_result=mysqli_query($conn,"select * from product where id='$id'");
							$product_row=mysqli_fetch_assoc($product_result);
							
					?>
                      <tr>
                        <td><?php echo $product_row['name']?></td>
                        <td><img src="../<?php echo $product_row['image']?>" width="100px" alt="product img" /></td>
                        <td><?php echo $product_qty?></td>
                        <td><?php echo $product_row['price']?></td>
                        <td><?php echo $product_qty*$product_row['price']?></td>
                      </tr>
					<?php
						$total_price+=$product_qty*$product_row['price'];
						}
					?>  
					<tr>
						<td colspan="3"></td>
						<td class="product-name"><b>TOTAL PRICE </b></td>
						<td class="product-name"><?php echo $total_price?></td>
					</tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>
        <!---Container Fluid-->


<?php
	require('footer.inc.php');
?>