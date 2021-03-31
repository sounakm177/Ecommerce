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
            <h1 class="h3 mb-0 text-gray-800">ALL PRODUCT</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="product.php">Product</a></li>
            </ol>
          </div>
		  
 <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><a class="btn btn-sm btn-dark" href="add_product.php">ADD PRODUCT</a></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
						<th>Img</th>
                        <th>Categories</th>
                        <th>Product</th>
                        <th>Mrp</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Active</th>
						<th>Best Seller</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
						<th>Img</th>
                        <th>Categories</th>
                        <th>Product</th>
                        <th>Mrp</th>
                        <th>Price</th>
                        <th>Qty</th>
						<th>Active</th>
						<th>Best Seller</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
					<?php
						$sql="select product.*,categories.categories from product, categories where product.categories_id=categories.id order by product.id desc";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
							
					?>
					 <tr>
					  <td><img src="<?php echo "../".$row['image']?>" height="50px" width="50px"alt="IMG"></td>
                        <td><b><?php echo strtoupper($row['categories'])?></b></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['mrp']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['qty']?></td>
						<?php
							if($row['status']==0){
								echo  "<td><a class='btn btn-sm btn-dark'
										href='?type=status&oparation=active&id=".$row['id']."'>NO</a></td>";
							}else{
								echo  "<td><a class='btn btn-sm btn-success'
										href='?type=status&oparation=deactive&id=".$row['id']."'>YES</a></td>";
							}
							
							if($row['best_seller']==0){
								
								echo  "<td><a class='btn btn-sm btn-info'
										href='?type=status&oparation=best_on&id=".$row['id']."'>NO</a></td>";
							}else{
								
								echo  "<td><a class='btn btn-sm btn-warning'
										href='?type=status&oparation=best_off&id=".$row['id']."'>YES</a></td>";
							}
						?>
                        <td>
							<a class="btn btn-sm btn-primary" href="add_product.php?type=edit&id=<?php
							echo $row['id']?>">EDIT</a>
							<a class="btn btn-sm btn-danger" href="?type=status&oparation=delete&id=<?php
							echo $row['id']?>">DELETE</a>
						
						</td>
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