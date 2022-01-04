<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Precio</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($prices[0]['id'])) echo $prices[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Origen</th>
		  			    				<td><?php if(!empty($prices[0]['from'])) echo $prices[0]['from'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Destino</th>
		  			    				<td><?php if(!empty($prices[0]['to'])) echo $prices[0]['to'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Precio</th>
		  			    				<td><?php if(!empty($prices[0]['value'])) echo $prices[0]['value'];?></td>
		  		    		    	</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CPrices/index" class="btn btn-primary pull-right" role="button">
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

      	$('#li-users').addClass('menu-open');
      	$('#ul-users').css('display', 'block');
    });
  
</script>
</body>
</html>