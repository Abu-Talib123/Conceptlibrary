  <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Cart Review</span>
      </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 col-md-6 mb-12">
			<div class="card panel-info">
				<div class="card-header bg-primary text-white">
					<div class="panel-title">
						<div class="row">
							<div class="col-lg-8 col-md-8 mb-12">
								<h5><span class="fa fa-shopping-cart"></span> &nbsp;&nbsp;Review your Cart</h5>
							</div>
							<div class="col-lg-4 col-md-4 mb-12" style="text-align: right;">
								<button  type="button" class="btn btn-primary" onclick="history.back();">
									Continue shopping
								</button>
								<?php  if(!empty($cartdata)) { ?>
									<button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
								<?php  } ?>
							</div>
						</div>
					</div>
				</div>
				<br/>
				<div class="card-body" id="cart_detail">
				<form role="form" name="frm_checkout" id="frm_checkout" action="#" method="POST" enctype="multipart/form-data">

					<table class="table table-bordered">
				    <thead>
				      <tr>
				        <th>#</th>
				        <th><h4 class="product-name">Product Name</h4></th>
				        <th><h4 class="product-name">Type</h4></th>
				        <th><h4 class="product-name">Price</h4></th>
				        <th><h4 class="product-name">Action</h4></th>
				      </tr>
				    </thead>
				    <tbody>
				    
					<?php 
					$count =  0;
					 $i = 1;
					 $sum=0;
					if($cartdata) {
					
					 
	  				foreach($cartdata as $item)
	 				{
	 				    
	 				 ?>

		 				 <tr>
					        <td><?=$i?></td>
					         <td><h4 class="mtop1"><strong><?php echo $item['subcategory_name'];?></strong></h4></td>
					         <td><h4 class="mtop1"><?php echo $item['domain_type'];?></h4></td>
					         <td><h4 class="mtop1 text-right">&#8377; <?php echo number_format ($item['subcategory_price'],2);?></h4></td>
					         <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="<?php echo $item['id'];?>">Remove</button></td>
							<input type="hidden" name="material_id[]" id="material_id" value="<?php echo $item['subcategory_id'];?>"/>
							<input type="hidden" name="material_type[]" id="material_type" value="<?php echo $item['domain_type'];?>"/>
							<input type="hidden" name="material_price[]" id="material_price" value="<?php echo $item['subcategory_price'];?>"/>
							
						 </tr>
					<hr>
				<?php 
						$i++;
						$sum+= $item['subcategory_price'];
 						$count++;
					}
					?>
				<tr>
					<td colspan="3" class="text-right"><h4>Total</h4></td>
					<td ><h4 class="text-right"> <strong> &#8377;<?php echo number_format($sum,2) ;?></strong></h4></td>
					<td>&nbsp;</td>
				</tr>
			<?php } else {
				?>
				<tr>
					
					<td colspan="5" class="text-center"><h4 >No Items  In Your Cart</h4> </td>
				</tr>
			<?php } ?>
				 </tbody>
				  </table>
				  <?php if($cartdata) {?>				
					<div class="row text-center">							
						<div class="col-lg-12 col-md-12 mb-12 text-right">
							<input type="hidden" value="<?php echo $sum;?>">
							<input  id="submit-pay" type="submit" value="Continue to Payment" class="btn btn-primary" />
						</div>
					</div>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>		
				