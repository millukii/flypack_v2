<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Persona</h3>
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
		  		    	    			<th>Nombres</th>
		  		    	    			<td><?php if(!empty($company[0]['name'])) echo $company[0]['name'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Apellidos</th>
		  		    	    			<td><?php if(!empty($company[0]['lastname'])) echo $company[0]['lastname'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Dirección</th>
		  		    	    			<td><?php if(!empty($company[0]['address'])) echo $company[0]['address'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Teléfono</th>
		  		    	    			<td><?php if(!empty($company[0]['phone'])) echo $company[0]['phone'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Email</th>
		  		    	    			<td><?php if(!empty($company[0]['email'])) echo $company[0]['email'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Perfil</th>
		  		    	    			<td><?php if(!empty($company[0]['profile'])) echo $company[0]['profile'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Estado</th>
		  		    	    			<td><?php if(!empty($company[0]['state'])) echo $company[0]['state'];?></td>
		  		    	    		</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($company[0]['created'])) echo $company[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($company[0]['modified'])) echo $company[0]['modified'];?></td>
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