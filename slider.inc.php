
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
								$banenr_sql="select * from banner";
								$banner_result=mysqli_query($conn,$banenr_sql);
								$banner_row=mysqli_num_rows($banner_result);
								for($i=0; $i<$banner_row; $i++){
									if($i==0){
										echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'" class="active"></li>';
									}else{
										echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'"></li>';
									}
								}
							?>
						</ol>
						
						<div class="carousel-inner">
							<?php
								$item=0;
								$banenr_sql="select * from banner";
								$banner_result=mysqli_query($conn,$banenr_sql);
								while($row=mysqli_fetch_assoc($banner_result)){
									if($item==0){
							?>
								<div class="item active">
									<div class="col-sm-6">
										<h1><span><?php echo $row['head']?></span></h1>
										<h2><?php echo $row['sub_head']?></h2>
										<p><?php echo $row['para']?> </p>
										<a href="product.php?type=categories&id=<?php echo $row['button_set']?>" class="btn btn-default get">Get it now</a>
									</div>
									<div class="col-sm-6">
										<img src="<?php echo $row['img']?>" width="100%" class="girl img-responsive" alt="" />
										
									</div>
								</div>
							<?php
									}else{
										?>
									<div class="item">
										<div class="col-sm-6">
											<h1><span><?php echo $row['head']?></span></h1>
											<h2><?php echo $row['sub_head']?></h2>
											<p><?php echo $row['para']?> </p>
											<a href="product.php?type=categories&id=<?php echo $row['button_set']?>" class="btn btn-default get">Get it now</a>
										</div>
										<div class="col-sm-6">
											<img src="<?php echo $row['img']?> " class="girl img-responsive" alt="" />
											
										</div>
									</div>
							<?php
									}
									$item++;
								}
								
							?>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
