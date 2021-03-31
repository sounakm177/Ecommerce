<?php
	require('header.inc.php');
	
	if(isset($_GET['oparetion']) && $_GET['oparetion']!=''){
		$oparetion=get_value($conn,$_GET['oparetion']);
		if($oparetion=='delete'){
			if(isset($_GET['id']) && $_GET['id']!=''){
				$id=get_value($conn,$_GET['id']);
				$check_sql="select * from contact_us where id='$id'";
				$check=mysqli_num_rows(mysqli_query($conn,$check_sql));
				if($check>0){
					$sql="delete from contact_us where id='$id'";
					mysqli_query($conn,$sql);
				}else{
					?>
					<script>
						window.location.href="contact_us.php";
					</script>
					<?php
			die();
				}
			}
		}else{
			?>
				<script>
					window.location.href="contact_us.php";
				</script>
			<?php
			die();
		}
	} 
	
?>

  <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Contact US</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="contact_us.php">Contact Us</a></li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Contact US</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$sql="select * from contact_us";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
					?>
                      <tr>
                        <td><a href="#">#</a></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['subject']?></td>
                        <td><?php echo $row['comment']?></td>
                        <td><a href="contact_us.php?oparetion=delete&id=<?php echo $row['id']?>" class="btn btn-sm btn-danger">Delete</a></td>
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
          <!--Row-->
        </div>
        <!---Container Fluid-->


<?php
	require('footer.inc.php');
?>