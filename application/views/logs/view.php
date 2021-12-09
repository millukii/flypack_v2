<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-file-text"></i>
						<h3 class="box-title">Log</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($log[0]['id'])) echo $log[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Asunto</th>
		  			    				<td><?php if(!empty($log[0]['subject'])) echo $log[0]['subject'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Acción Log</th>
		  			    				<td><?php if(!empty($log[0]['action'])) echo $log[0]['action'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Usuario</th>
		  			    				<td><?php if(!empty($log[0]['user'])) echo $log[0]['user'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Fecha</th>
		  			    				<td><?php if(!empty($log[0]['created'])) echo $log[0]['created'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Descripción</th>
		  			    				<td>
		  			    					<?php 
		  			    						if(!empty($log[0]['description']))
		  			    						{
		  			    							$array = unserialize($log[0]['description']);
		  			    							for($i=0; $i<count($array); $i++)
		  			    							{
		  			    								echo '<table class="table table-striped">';
		  			    								if(!empty($array[$i]))
		  			    								{
		  			    									foreach($array[$i] as $llave=>$valor)
															{
																echo '<tr>';
																echo '<td>'.$llave.'</td>';
																echo '<td>'.$valor.'</td>';
																echo '</tr>';
															}
		  			    								}
		  			    								
														echo '</table>';
		  			    							}
		  			    							
		  			    						}
		  			    					?>
		  			    					
		  			    				</td>
		  		    		    	</tr>
		  		    		    	

		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CLogs/index" class="btn btn-primary pull-right" role="button">
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
      	$('#li-utils').addClass('menu-open');
      	$('#ul-utils').css('display', 'block');
    });
  
  	function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
</body>
</html>