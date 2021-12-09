<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-cart-plus"></i>
						<h3 class="box-title">Producto</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($product[0]['id'])) echo $product[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Producto</th>
		  			    				<td><?php if(!empty($product[0]['product'])) echo $product[0]['product'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Descripción</th>
		  			    				<td><?php if(!empty($product[0]['description'])) echo $product[0]['description'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Variedad</th>
		  			    				<td><?php if(!empty($product[0]['variety'])) echo $product[0]['variety'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($product[0]['created'])) echo $product[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($product[0]['modified'])) echo $product[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CProducts/index" class="btn btn-primary pull-right" role="button">
	                    <i class='fa fa-undo'></i> Volver
	                </a>
				  	</div>
				</div>
			</div>
		</div>
	</section>
	
</div>

<?php $this->view('footer'); ?>

<script>
    $(document).ready(function() {
      	$('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-orchards').addClass('menu-open');
      $('#ul-orchards').css('display', 'block');
    });
  
</script>
</body>
</html>