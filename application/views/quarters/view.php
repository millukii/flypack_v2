<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-industry"></i>
						<h3 class="box-title">Cuartel</h3>
				  	</div>

			  			<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($quarters[0]['id'])) echo $quarters[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Número</th>
		  			    				<td><?php if(!empty($quarters[0]['number'])) echo $quarters[0]['number'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Nombre Cuartel</th>
		  		    	    			<td><?php if(!empty($quarters[0]['quarter'])) echo $quarters[0]['quarter'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Huerto</th>
		  		    	    			<td><?php if(!empty($quarters[0]['orchard'])) echo $quarters[0]['orchard'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Producto/s</th>
		  		    	    			<td><?php 
		  		    	    					if(!empty($products))
		  		    	    					{
		  		    	    						foreach($products as $p)
		  		    	    						{
		  		    	    							echo $p['product'].' | '.$p['variety'].'<br>';
		  		    	    						}
		  		    	    					}

		  		    	    				?></td>
		  		    	    		</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($quarters[0]['created'])) echo $quarters[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($quarters[0]['modified'])) echo $quarters[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>

			  			<div class="box-footer">
					  		<a href="<?php echo site_url(); ?>/CQuarters/index" class="btn btn-primary pull-right" role="button">
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
	$(document).ready(function()
	{

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-orchards').addClass('menu-open');
      	$('#ul-orchards').css('display', 'block');
	});
</script>
</body>
</html>
