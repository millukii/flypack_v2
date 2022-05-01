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
		  			    				<td><?php if (!empty($user[0]['id'])) {
    echo $user[0]['id'];
}
?></td>
		  		    		    	</tr>
									<tr>
		  		    		    		<th>Usuario</th>
		  			    				<td><?php if (!empty($user[0]['user'])) {
    echo $user[0]['user'];
}
?></td>
		  		    		    	</tr>
                          			<tr>
                          				<th>Rol</th>
                          				<td><?php if (!empty($user[0]['rol'])) {
    echo $user[0]['rol'];
}
?></td>
                          			</tr>
                          			<tr>
                          				<th>Nombre</th>
                          				<td><?php if (!empty($user[0]['name'])) {
    echo $user[0]['name'];
}
if (!empty($user[0]['lastname'])) {
    echo $user[0]['lastname'];
}
?></td>
                          			</tr>
									<tr>
                          				<th>Email</th>
                          				<td><?php if (!empty($user[0]['email'])) {
    echo $user[0]['email'];
}
?></td>
                          			</tr>
									<tr>
                          				<th>Empresa</th>
                          				<td><?php if (!empty($user[0]['rut'])) {
    echo $user[0]['rut'] . '-' . $user[0]['dv'] . ' ' . $user[0]['razon'];
}
?></td>
                          			</tr>
                          			<tr>
                          				<th>Estado</th>
                          				<td><?php if (!empty($user[0]['state'])) {
    echo $user[0]['state'];
}
?></td>
                          			</tr>
									<tr>
                          				<th>Creado</th>
                          				<td><?php if (!empty($user[0]['created'])) {
    echo $user[0]['created'];
}
?></td>
                          			</tr>
									  <tr>
                          				<th>Modificado</th>
                          				<td><?php if (!empty($user[0]['modified'])) {
    echo $user[0]['modified'];
}
?></td>
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

<?php $this->view('footer');?>

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