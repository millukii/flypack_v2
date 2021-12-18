<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-balance-scale "></i>
						<h3 class="box-title">Unidad de Medida</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($unit[0]['id'])) echo $unit[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Unidad de Medida</th>
		  			    				<td><?php if(!empty($unit[0]['unit'])) echo $unit[0]['unit'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Acrónimo</th>
		  			    				<td><?php if(!empty($unit[0]['acronym'])) echo $unit[0]['acronym'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($unit[0]['created'])) echo $unit[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($unit[0]['modified'])) echo $unit[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CUnits/index" class="btn btn-primary pull-right" role="button">
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

      	$('#li-containers').addClass('menu-open');
      	$('#ul-containers').css('display', 'block');
    });
  
</script>
</body>
</html>