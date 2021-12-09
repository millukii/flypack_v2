<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-suitcase"></i>
						<h3 class="box-title">Contenedor</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($container[0]['id'])) echo $container[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Contenedor</th>
		  			    				<td><?php if(!empty($container[0]['container'])) echo $container[0]['container'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Peso</th>
		  		    	    			<td><?php if(!empty($container[0]['weight'])) echo $container[0]['weight'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Unidad de Medida</th>
		  		    	    			<td><?php if(!empty($container[0]['acronym'])) echo $container[0]['acronym'];?> | <?php if(!empty($container[0]['unit'])) echo $container[0]['unit'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Valor Pago $</th>
		  		    	    			<td id="td-value_payment"><?php if(!empty($container[0]['value_payment'])) echo $container[0]['value_payment'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Valor Venta $</th>
		  		    	    			<td id="td-value_sale"><?php if(!empty($container[0]['value_sale'])) echo $container[0]['value_sale'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Producto</th>
		  		    	    			<td><?php if(!empty($container[0]['product'])) echo $container[0]['product'];?> | <?php if(!empty($container[0]['variety'])) echo $container[0]['variety'];?></td>
		  		    	    		</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($container[0]['created'])) echo $container[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($container[0]['modified'])) echo $container[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CContainers/index" class="btn btn-primary pull-right" role="button">
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

    	$('#td-value_sale').html(separatorMiles($('#td-value_sale').html()));
    	$('#td-value_payment').html(separatorMiles($('#td-value_payment').html()));

      	$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-containers').addClass('menu-open');
      	$('#ul-containers').css('display', 'block');
    });
  
  	function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
</body>
</html>