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
		  			    				<td><?php if(!empty($people[0]['id'])) echo $people[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Rut</th>
		  			    				<td><?php if(!empty($people[0]['rut'])) echo $people[0]['rut'];?>-<?php if(!empty($people[0]['dv'])) echo $people[0]['dv'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Nombres</th>
		  		    	    			<td><?php if(!empty($people[0]['name'])) echo $people[0]['name'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Apellidos</th>
		  		    	    			<td><?php if(!empty($people[0]['lastname'])) echo $people[0]['lastname'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Dirección</th>
		  		    	    			<td><?php if(!empty($people[0]['address'])) echo $people[0]['address'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Teléfono</th>
		  		    	    			<td><?php if(!empty($people[0]['phone'])) echo $people[0]['phone'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Email</th>
		  		    	    			<td><?php if(!empty($people[0]['email'])) echo $people[0]['email'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Perfil</th>
		  		    	    			<td><?php if(!empty($people[0]['profile'])) echo $people[0]['profile'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Estado</th>
		  		    	    			<td><?php if(!empty($people[0]['state'])) echo $people[0]['state'];?></td>
		  		    	    		</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($people[0]['created'])) echo $people[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($people[0]['modified'])) echo $people[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CPeople/index" class="btn btn-primary pull-right" role="button">
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

      	$('#li-people').addClass('menu-open');
      	$('#ul-people').css('display', 'block');
    });
  
</script>
</body>
</html>