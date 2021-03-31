	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
							<?php
								$categories_sql="select * from categories where status=1";
								$categories_result=mysqli_query($conn,$categories_sql);
								while($categories_row=mysqli_fetch_assoc($categories_result)){
							?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a href="product.php?type=categories&id=<?php echo $categories_row['id']?>">
											<?php echo $categories_row['categories']?>
										</a>
										</h4>
									</div>
								</div>
								<?php	
								}
								?>
							</div>
							
						</div><!--/category-products-->
					
						
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				