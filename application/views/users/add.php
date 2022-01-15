<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Agregar usuario</h3>
				  	</div>

				  	<form class="form-horizontal" id="form-users">
			  			<div class="box-body">

			  				<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Usuario</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-user" id="input-user" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Contraseña</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="input-password" id="input-password" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="roles_id" class="col-sm-2 control-label">Rol</label>
			  					<div class="col-sm-5">
			  						<select name="select-roles_id" id="select-roles_id" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($roles as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->rol; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Nombre</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-name" id="input-name" required>
			  					</div>
			  				</div>

							  <div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Apellido</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-lastname" id="input-lastname" required>
			  					</div>
			  				</div>

							  <div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Email</label>
			  					<div class="col-sm-10">
			  						<input type="email" class="form-control" name="input-email" id="input-email" required>
			  					</div>
			  				</div>

							  <div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Teléfono</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-phone" id="input-phone" required>
			  					</div>
			  				</div>

							<div class="form-group">
			  					<label for="users_state_id" class="col-sm-2 control-label">Empresa</label>
			  					<div class="col-sm-5">
			  						<select name="select-companies_id" id="select-companies_id" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($companies as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->rut.'-'.$key->dv.' '.$key->razon; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="users_state_id" class="col-sm-2 control-label">Estado usuario</label>
			  					<div class="col-sm-5">
			  						<select name="select-user_states_id" id="select-user_states_id" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($user_states as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->state; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>
			  				<!--  -->
			  				
			  				<!--  -->
			  			</div>
			  			<div class="box-footer">
			  				<button type="submit" class="btn btn-primary pull-right">Guardar</button>
			  			</div>
			  		</form>
				</div>
			</div>
		</div>
	</section>

</div>

<?php $this->view('footer'); ?>

<script>
	$(document).ready(function() {
		$("#form-users").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CUsers/addUser",{
					user 			: 	$("#input-user").val(),
					password 		: 	$("#input-password").val(),
					roles_id 		: 	$("#select-roles_id").val(),
					name 			: 	$("#input-name").val(),
					lastname 		: 	$("#input-lastname").val(),
					email 			: 	$("#input-email").val(),
					phone 			: 	$("#input-phone").val(),
					companies_id 	: 	$("#select-companies_id").val(),
					user_states_id	: 	$("#select-user_states_id").val()
				},
				function(data){
					if (data == 1) {
						window.location.replace(site_url+"/CUsers/index");
					}
					else {
						alert("Usuario existente.");
						//window.location.replace(site_url+"/CUsers/add");
					}
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

		$('#li-users').addClass('menu-open');
		$('#ul-users').css('display', 'block');
	});
</script>
</body>
</html>
