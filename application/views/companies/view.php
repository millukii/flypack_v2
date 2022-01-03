<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Company</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($company[0]['id'])) echo $company[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Rut</th>
		  			    				<td><?php if(!empty($company[0]['rut'])) echo $company[0]['rut'];?>-<?php if(!empty($company[0]['dv'])) echo $company[0]['dv'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Razon</th>
		  		    	    			<td><?php if(!empty($company[0]['razon'])) echo $company[0]['razon'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Nombre de Fantasia</th>
		  		    	    			<td><?php if(!empty($company[0]['fantasy'])) echo $company[0]['fantasy'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Dirección</th>
		  		    	    			<td><?php if(!empty($company[0]['address'])) echo $company[0]['address'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>City</th>
		  		    	    			<td><?php if(!empty($company[0]['city'])) echo $company[0]['city'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Comuna</th>
		  		    	    			<td><?php if(!empty($company[0]['commune'])) echo $company[0]['commune'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Representante Legal</th>
		  		    	    			<td><?php if(!empty($company[0]['people_id'])) echo $company[0]['people_id'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CCompany/index" class="btn btn-primary pull-right" role="button">
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

      	$('#li-company').addClass('menu-open');
      	$('#ul-company').css('display', 'block');
    });
  
</script>
</body>
</html>