<?php
	require('header.inc.php');
	
	if(isset($_GET['type']) && $_GET['type']!=''){
		$type=get_value($conn,$_GET['type']);
		if($type=="status"){
			$oparation=get_value($conn,$_GET['oparation']);
			$id=get_value($conn,$_GET['id']);
			if($oparation=='active'){
				$status=1;
				$sql="update categories set status='$status' where id='$id'";
				mysqli_query($conn,$sql);
			}else if($oparation=='deactive'){
				$status=0;
				$sql="update categories set status='$status' where id='$id'";
				mysqli_query($conn,$sql);
			}else{
				// delete code
				$sql="delete from categories where id='$id'";
				mysqli_query($conn,$sql);
			}
		}
	}
?>
	<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">PRODUCT CATEGORIES</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="categories.php">categories</a></li>
           </ol>
		</div>
		
		 <div class="row">
            <div class="col-lg-8 offset-lg-2 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><a class="btn btn-danger" href="add_categories.php">ADD CATEGORIES</a></h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="table-dark">
                      <tr>
                        <th>#</th>
                        <th>CATEGORIES</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$sql="select * from categories dasc";
						$result=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($result)){
					?>
                      <tr>
                        <td><a href="#">#</a></td>
                        <td><?php echo $row['categories']?></td>
                        <td>
						<?php
							if($row['status']==1){
								echo '<a class="btn btn-sm btn-primary" href="?type=status&oparation=deactive&id='.$row['id'].'">ACTIVE</a>';
							}else{
								echo '<a class="btn btn-sm btn-dark" href="?type=status&oparation=active&id='.$row['id'].'">DEACTIVE</a>';
							}
						?>
							<a class="btn btn-sm btn-success" href="add_categories.php?id=<?php echo $row['id']?>">EDIT</a>
							<a class="btn btn-sm btn-danger" href="?type=status&oparation=delete&id=<?php echo $row['id']?>">DELETE</a>
						
						</td>
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
	
<?php
	require('footer.inc.php');
?>