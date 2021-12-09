<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Usuario</h3>
				  	</div>
					
					<div class="box-body">
			  			<section class="content">
			  			    <table id="sensors" class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($user[0]['id'])) echo $user[0]['id'];?></td>
		  		    		    	</tr>
									<tr>
		  		    		    		<th>Usuario</th>
		  			    				<td><?php if(!empty($user[0]['user'])) echo $user[0]['user'];?></td>
		  		    		    	</tr>
                          			<tr>
                          				<th>Rol</th>
                          				<td><?php if(!empty($user[0]['rol'])) echo $user[0]['rol'];?></td>
                          			</tr>
                          			<tr>
                          				<th>Persona</th>
                          				<td><?php if(!empty($user[0]['name'])) echo $user[0]['name'];?></td>
                          			</tr>
                          			<tr>
                          				<th>Estado</th>
                          				<td><?php if(!empty($user[0]['state'])) echo $user[0]['state'];?></td>
                          			</tr>

                          			
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CUsers/index" class="btn btn-primary pull-right" role="button">
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