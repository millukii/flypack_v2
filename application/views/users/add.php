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
			  					<label for="people_id" class="col-sm-2 control-label">Persona</label>
			  					<div class="col-sm-5">
			  						<select name="select-people_id" id="select-people_id" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($people as $key) { ?>
			  								<!--
			  								<option value="<?php //echo $key->id; ?>"><?php //echo $key->rut."-".$key->dv." | ". $key->name." ".$key->lastname; ?></option>
			  								-->
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->rut." | ". $key->name." ".$key->lastname; ?></option>
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
					people_id 		: 	$("#select-people_id").val(),
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
