<?php
	require('header.inc.php');

	$cat_value="";
	$cat_id='';
	$error='';
	if(isset($_GET['id']) && $_GET['id']!=''){
		$id=get_value($conn,$_GET['id']);
		$sql="select * from categories where id='$id'";
		$result=mysqli_query($conn,$sql);
		$check=mysqli_num_rows($result);
		if($check>0){
			$row=mysqli_fetch_assoc($result);
			$cat_value=$row['categories'];
			$cat_id=$id;
		}else{
			?>
			<script>
				window.location.href='categories.php';
			</script>
		<?php
		die();
		}
	}
	
	
	//submit code and edit code
	if(isset($_POST['submit'])){
		if(isset($cat_id) && $cat_id!=''){
			$categories=get_value($conn,$_POST['name']);
			$sql="select * from categories where categories='$categories'";
			$check=mysqli_num_rows(mysqli_query($conn,$sql));
			if($check>0){
				$error="Categorise Alredy Extis Database !!!";
			}else{
				$sql="update categories set categories='$categories' where id='$id'";
				mysqli_query($conn,$sql);
				?>
				<script>
					window.location.href='categories.php';
				</script>
			<?php
				die();
			}
			?>
			<script>
				window.location.href='categories.php';
			</script>
		<?php
			die();
		}else{
			$categories=get_value($conn,$_POST['name']);
			$status='1';
			$sql="select * from categories where categories='$categories'";
			$check=mysqli_num_rows(mysqli_query($conn,$sql));
			if($check>0){
				$error="Categorise Alredy Extis Database !!!";
			}else{
				$sql="insert into categories (categories,status) values('$categories','$status')";
				mysqli_query($conn,$sql);
				?>
				<script>
					window.location.href='categories.php';
				</script>
			<?php
				die();
			}
			
		}
	}
	
?>
	<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800"><?php $cat_value?>CATEGORIES ADD</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="categories.php">categories</a></li>
           </ol>
		</div>
		  <!-- Form Basic -->
              <div class="card mb-4 col-lg-8 offset-lg-2 mb-5 ">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Menage Item Categories</h6>
                </div>
                <div class="card-body">
                  <form method='post'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Categories Name</label>
                      <input type="text" class="form-control" name="name" aria-describedby="emailHelp"
                        placeholder="Enter email" required value="<?php echo $cat_value?>">
                      <small id="emailHelp" class="form-text text-muted">
                       </small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form>
				  <span style="color:red;"><?php echo $error?></span>
                </div>
              </div>
	
<?php
	require('footer.inc.php');
?>

