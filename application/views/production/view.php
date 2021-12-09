<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					     <i class="fa fa-file-text"></i>
						<h3 class="box-title">Producción</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($production[0]['id'])) echo $production[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Proceso</th>
		  			    				<td><?php if(!empty($production[0]['process'])) echo $production[0]['process'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Huerto</th>
		  		    	    			<td><?php if(!empty($production[0]['orchard'])) echo $production[0]['orchard'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Cuartel</th>
		  		    	    			<td><?php if(!empty($production[0]['quarter'])) echo $production[0]['quarter'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Producto</th>
		  		    	    			<td><?php if(!empty($production[0]['product'])) echo $production[0]['product'];?> | <?php if(!empty($production[0]['variety'])) echo $production[0]['variety'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Contenedor</th>
		  		    	    			<td><?php if(!empty($production[0]['container'])) echo $production[0]['container'];?> | <?php if(!empty($production[0]['weight'])) echo $production[0]['weight'];?> <?php if(!empty($production[0]['acronym'])) echo $production[0]['acronym'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Persona</th>
		  		    	    			<td><?php if(!empty($production[0]['rut'])) echo $production[0]['rut'];?>-<?php if(!empty($production[0]['dv'])) echo $production[0]['dv'];?> | <?php if(!empty($production[0]['name'])) echo $production[0]['name'];?> <?php if(!empty($production[0]['lastname'])) echo $production[0]['lastname'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Cantidad</th>
		  		    	    			<td><?php if(!empty($production[0]['quantity'])) echo $production[0]['quantity'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Valor Pago $</th>
		  		    	    			<td id="td-value_payment"><?php if(!empty($production[0]['value_payment'])) echo $production[0]['value_payment'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Valor Venta $</th>
		  		    	    			<td id="td-value_sale"><?php if(!empty($production[0]['value_sale'])) echo $production[0]['value_sale'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Controlado</th>
		  		    	    			<td>
		  		    	    				<?php 


		  		    	    					$controller_id = 0;

		  		    	    					if(!empty($production[0]['controller_id'])) $controller_id = $production[0]['controller_id'];

		  		    	    					$this->db->select('rut, dv, name, lastname');
		  		    	    					$this->db->from('people');
		  		    	    					$this->db->where('id', $controller_id);
		  		    	    					$this->db->limit(1);

		  		    	    					$res = $this->db->get()->result_array();
		  		    	    					if(!empty($res[0]['rut']))
		  		    	    						$res = $res[0]['rut'].'-'.$res[0]['dv'].' | '.$res[0]['name'].' '.$res[0]['lastname'];
		  		    	    					else
		  		    	    						$res = 'Sin controlador asociado.';

		  		    	    					echo $res;
		  		    	    				?>
		  		    	    			</td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Fecha</th>
		  		    	    			<td><?php if(!empty($production[0]['date'])) echo $production[0]['date'];?></td>
		  		    	    		</tr>

		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CProduction/index" class="btn btn-primary pull-right" role="button">
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
    	$('#td-value_sale').html(separatorMiles($('#td-value_sale').html()));
    	$('#td-value_payment').html(separatorMiles($('#td-value_payment').html()));

      	$('#li-production').addClass('menu-open');
      	$('#ul-production').css('display', 'block');
    });
  
  	function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
</body>
</html>