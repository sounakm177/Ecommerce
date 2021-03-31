<?php
	require('header.inc.php');
	// variable declear for to bring value from product page
	$product_name="";
	$categories_name="";
	$mrp="";
	$price="";
	$qty="";
	$desc="";
	$short_desc="";
	$meta_title="";
	$meta_desc="";
	$meta_keyword="";
	$best_seller="";
	$cat_id="0";
	$id='';
	$status=1;
	$img='';
	$require='required';
	$msg='';
	
	//value set who has brought from product page
	if(isset($_GET['type']) && $_GET['type']!=''){
		$edit=get_value($conn,$_GET['type']);
		if($edit=='edit'){
			if(isset($_GET['id']) && $_GET['id']!=''){
				$id=get_value($conn,$_GET['id']);
				$id_check_sql="select * from product where id='$id'";
				if(mysqli_num_rows(mysqli_query($conn,$id_check_sql))>0){
					$sql="select * from product where id='$id'";
					$row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
			
					$product_name=$row['name'];
					$mrp=$row['mrp'];
					$price=$row['price'];
					$qty=$row['qty'];
					$desc=$row['description'];
					$short_desc=$row['short_description'];
					$meta_title=$row['meta_title'];
					$meta_desc=$row['meta_desc'];
					$meta_keyword=$row['meta_keyword'];
					$best_seller=$row['best_seller'];
					$cat_id=$row['categories_id'];
					$status=$row['status'];
					$require="";
					//to take value from categories
					$sql="select * from categories where id='$cat_id'";
					$row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
					$categories_name=$row['categories'];
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
	}
	
	//upload and insert data when will be click submit button
	if(isset($_POST['submit'])){
		
		//set value by post method 
		$name=get_value($conn,$_POST['pname']);
		$categories_id=get_value($conn,$_POST['categories_id']);
		$mrp=get_value($conn,$_POST['pmrp']);
		$price=get_value($conn,$_POST['pprice']);
		$qty=get_value($conn,$_POST['pqty']);
		$description=get_value($conn,$_POST['pdesc']);
		$short_description=get_value($conn,$_POST['psdesc']);
		$meta_title=get_value($conn,$_POST['pmtitle']);
		$meta_desc=get_value($conn,$_POST['pmdesc']);
		$meta_keyword=get_value($conn,$_POST['pmkey']);
		$status=1;
		
		//check best_seller is on or off.
		if(isset($_POST['pbest']) && $_POST['pbest']!=''){
			$best_seller=get_value($conn,$_POST['pbest']);
			if($best_seller=='on'){
				$best_seller=1;
			}else{
				$best_seller=0;
			}
		}else{
			$best_seller=0;
		}
		
		// upload code 
		if(isset($_POST['check_id']) && $_POST['check_id']!=''){
			
			//chcek imgage 
			if(isset($_FILES['img']['name']) && $_FILES['img']['name']!=''){
				if($_FILES['img']['type']!='image/png' && $_FILES['img']['type']!='image/jpg' && $_FILES['img']['type']!='image/jpeg'){
					
					$msg="Please select only png, jpg and jpeg image formate";	
					?>
						<script>
						window.location.href=window.location.href;
						</script>
					<?php
				die();
				} 
				
				$img=rand(999999,111111).$_FILES['img']['name'];
				$img_path="images/product/".$img;
				$img_tmp=$_FILES['img']['tmp_name'];
				move_uploaded_file($img_tmp,"../".$img_path);
				$upload_img_path=$img_path;
			}
			
			$id=get_value($conn,$_POST['check_id']);
			$status=get_value($conn,$_POST['status']);
			
			//if image store that is why check it.
			if(isset($upload_img_path) && $upload_img_path!=''){
				
				$sql="select image from product where id='$id'";
				$row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
				//unlink image to chenge image
				if(isset($row['image']) && $row['image']!=''){
					$img_path="../".get_value($conn,$row['image']);
					
					if (file_exists($img_path)){
						unlink($img_path);
					}else{}	
				}
				// with image upload 
				$update_sql="update product set 
				name='$name', categories_id='$categories_id', mrp='$mrp', price='$price',
				qty='$qty', image='$upload_img_path', description='$description', short_description='$short_description',
				meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', 
				best_seller='$best_seller', status='$status'
				where id='$id'";
				mysqli_query($conn,$update_sql);
				?>
				<script>
					window.location.href='product.php';
				</script>
				<?php
				die();
			}else{
				//without image upload
				$update_sql="update product set 
				name='$name', categories_id='$categories_id', mrp='$mrp', price='$price',
				qty='$qty', description='$description', short_description='$short_description',
				meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', 
				best_seller='$best_seller', status='$status'
				where id='$id'";
				mysqli_query($conn,$update_sql);
				?>
				<script>
					window.location.href='product.php';
				</script>
				<?php
				die();
			}
		//insert code.
		}else{
			if(isset($_FILES['img']['name']) && $_FILES['img']['name']!=''){
				
				if($_FILES['img']['type']!='image/png' && $_FILES['img']['type']!='image/jpg' && $_FILES['img']['type']!='image/jpeg'){
					
					?>
						<script>
						window.location.href=window.location.href;
						</script>
					<?php
				die();
				} 
				
				$img=rand(999999,111111).$_FILES['img']['name'];
				$img_path="images/product/".$img;
				$img_tmp=$_FILES['img']['tmp_name'];
				move_uploaded_file($img_tmp,"../".$img_path);
				$inser_sql="insert into product 
				(name, categories_id, mrp, price,
				qty, description, short_description, 
				meta_title, meta_desc, meta_keyword, 
				best_seller, status ,image)
				values('$name', '$categories_id', '$mrp', '$price',
				'$qty', '$description', '$short_description', 
				'$meta_title', '$meta_desc', '$meta_keyword', 
				'$best_seller', '$status', '$img_path')";
				mysqli_query($conn,$inser_sql);
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
            <h1 class="h3 mb-0 text-gray-800">INSERT PRODUCT ITEM</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="product.php">Product</a></li>
              <li class="breadcrumb-item"><a href="add_product.php">Manage Product</a></li>
            </ol>
          </div>
			
		<div class="row">
		 <div class="col-lg-8 offset-lg-2">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">******</h6>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Product Name :-</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="ITEM NAME " name="pname" value="<?php echo $product_name?>" <?php echo $require?>>
					 
					<! --  hidden edit data pass --> 
					 <input type="hidden" name="check_id" value="<?php echo $id?>">
					  <input type="hidden" name="status" value="<?php echo $status?>">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Categories Name</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="categories_id" <?php echo $require?>>
                        <option value="">Select Categories Name</option>
						<?php
								$sql="select * from categories";
								$result=mysqli_query($conn,$sql);
								while($row=mysqli_fetch_assoc($result)){
									if(isset($categories_name) && $categories_name!=''){
										if($cat_id==$row['id']){
											echo "<option value='".$row['id']."' selected>".$row['categories']."</option>";
										}else{
											echo "<option value='".$row['id']."'>".$row['categories']."</option>";
										}
									}else{
										echo "<option value='".$row['id']."'>".$row['categories']."</option>";
									}
								}
						?>
                      </select>
                    </div>
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product MRP :-</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="MRP " name="pmrp" value="<?php echo $mrp?>" <?php echo $require?>>
                    </div>
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product PRICE :-</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="PRICE " name="pprice" value="<?php echo $price?>" <?php echo $require?>>
                    </div>
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product QTY :-</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="QTY " name="pqty" value="<?php echo $qty?>" <?php echo $require?>>
                    </div>
					
					<label for="exampleFormControlInput1">Chose Product Image :-[JPG/PNG/JPEG]</label>
					<div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile"  name="img" <?php echo $require?>>
                        <label class="custom-file-label" for="customFile">Choose file (jpg/png/jpeg)</label>
					</div>
					
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Product Description :-</label>
                      <textarea name="pdesc" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $desc?></textarea>
                    </div>
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product Short Description :-</label>
                      <input type="text" name="psdesc" value="<?php echo $short_desc?>" class="form-control" id="exampleFormControlInput1"
                        placeholder="S-description ">
                    </div>
					
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product Meta Title :-</label>
                      <input type="text"  value="<?php echo $meta_title?>" name="pmtitle" class="form-control" id="exampleFormControlInput1"
                        placeholder="Meta Title ">
                    </div>
					
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product Meta Description :-</label>
                      <input type="text" name="pmdesc" value="<?php echo $meta_desc?>" class="form-control" id="exampleFormControlInput1"
                        placeholder="Meta Description ">
                    </div>
					
					
					<div class="form-group">
                      <label for="exampleFormControlInput1">Product Meta Keyword :-</label>
                      <input type="text" name="pmkey" value="<?php echo $meta_keyword?>" class="form-control" id="exampleFormControlInput1"
                        placeholder="Meta Keyword">
                    </div>
					
					<div class="form-group">
                      <label>BEST SELLER SWITCH :-</label>
					  <?php
						$check='';
						if($best_seller==1){
							$check="checked";
						}
					  ?>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" name="pbest" class="custom-control-input" id="customSwitch1" <?php echo $check?>>
                        <label class="custom-control-label" for="customSwitch1">Best Seller on/off</label>
                      </div>
                    </div>
					
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					
				  </form>
                </div>
              </div>   
            </div>
        </div>
<?php
	require('footer.inc.php');
?>