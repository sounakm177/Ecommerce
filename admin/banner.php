<?php
	require('header.inc.php');
	
	$msg='';
	
	//inset banner 
	if(isset($_POST['submit'])){
		$img_path="img";
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
				$img_path="images/Banner/".$img;
				$img_tmp=$_FILES['img']['tmp_name'];
				move_uploaded_file($img_tmp,"../".$img_path);
		}
		
		
		
		if(isset($_POST['head']) && $_POST['head']!=''){
			$head=get_value($conn,$_POST['head']);
			if(isset($_POST['sub_head']) && $_POST['sub_head']!=''){
				$sub_head=get_value($conn,$_POST['sub_head']);
				if(isset($_POST['para']) && $_POST['para']!='' && $_POST['categories_set']!='' && isset($_POST['categories_set'])){
					$para=get_value($conn,$_POST['para']);
					$categories_set=get_value($conn,$_POST['categories_set']);
					$check_sql="select * from banner where head='$head' and sub_head='$sub_head'
								and para='$para'";
					$check_result=mysqli_query($conn,$check_sql);
					if(mysqli_num_rows($check_result)>0){
						?>
							<script>
								alert("Alredy sotred!!");
							</script>
						<?php
					}else{
						$inser_sql="insert into banner (head,sub_head,para,img,button_set)
								values('$head','$sub_head','$para','$img_path','$categories_set')";
						mysqli_query($conn,$inser_sql);
					}
				}else{
					?>
							<script>
								window.location.href=window.location.href;
							</script>
						<?php
					die();
				}
			}
		}
	}
	
	
	//delete code banner
	if(isset($_GET['oparetion']) && $_GET['oparetion']!='' && isset($_GET['id']) && $_GET['id']!=''){
		$oparetion=get_value($conn,$_GET['oparetion']);
		if($oparetion=='delete'){
			$id=get_value($conn,$_GET['id']);
			$check_sql="select * from banner where id='$id'";
			$check_result=mysqli_query($conn,$check_sql);
			if(mysqli_num_rows($check_result)>0){
				$get_img="select * from banner where id='$id'";
				$get_img_result=mysqli_query($conn,$get_img);
				$img_row=mysqli_fetch_assoc($get_img_result);
				$img_path="../".get_value($conn,$img_row['img']);
				if(file_exists($img_path)){
						unlink($img_path);
				}else{}	
				$delete_sql="delete from banner where id='$id'";
				mysqli_query($conn,$delete_sql);
			}else{
				?>
					<script>
						window.location.href='banner.php';
					</script>
				<?php
				die();
			}
		}else{
			?>
					<script>
						window.location.href='banner.php';
					</script>
				<?php
				die();
		}
	}
	
?>
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
			<div class="alert alert-dark alert-dismissible" role="alert">
                <img class="pl-5" src='../images/banner/banner.jpg' height="250px"; alt="banner_img">
            </div>
            </div>
		</div>
		
		<div class="row ml-1">
		 <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Costomize Banner</h6>
				   <p class="m-0 font-weight-bold text-danger">***You can set four Banner !!</p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Banner Heading</label>
                      <input type="text" name="head" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter Banner Heading" required>
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputEmail1">Banner Sub Heading</label>
                      <input type="text" name="sub_head" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter Banner Sub-Heading" required>
                    </div>
					
					<div class="form-group">
                      <label for="exampleFormControlTextarea1">Banner Paragraph</label>
                      <textarea class="form-control" name="para" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
					
                    <div class="form-group">
					 <label for="exampleFormControlTextarea1">Please Choose jpg/png/jpeg </label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="img" required>
                        <label class="custom-file-label" for="customFile">Choose File jpeg/png/jpg</label>
                      </div>
                    </div>
					<div style="color:red;"><?php $msg?></div>
					
					<div class="form-group">
                      <label for="exampleFormControlSelect1">Categories Set In Button</label>
                      <select class="form-control" name="categories_set" id="exampleFormControlSelect1" name="categories_id" required="">
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
					
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
			
			 
            <div class="col-lg-6">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Show BannerS</h6>
				  <p class="m-0 font-weight-bold text-success">You can show four row data !!</p>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
						<th>banner image</th>
                        <th>banner heading</th>
                        <th>Sub heading</th>
                        <th>banner click</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$sql="select * from banner order by id desc limit 4";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
						$id=$row['button_set'];
						$pro_sql="select * from categories where id='$id'";
						$pro_row=mysqli_fetch_assoc(mysqli_query($conn,$pro_sql));
					?>
                      <tr>
					   <td><img src="../<?php echo $row['img']?>" width="50px"></td>
                        <td><?php echo $row['head']?></td>
                        <td><?php echo $row['sub_head']?></td>
                        <td><?php echo strtoupper($pro_row['categories'])?></td>
                        <td><a href="banner.php?oparetion=delete&id=<?php echo $row['id']?>" class="btn btn-sm btn-danger">Delete</a></td>
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
<?php
	require('footer.inc.php');
?>