<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Editar Usuario # <td><?php if(!empty($user[0]['id'])) echo $user[0]['id'];?></td></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-users">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Usuario</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-user" id="input-user" value="<?php if(!empty($user[0]['user'])) echo $user[0]['user'];?>" required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Contraseña</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="input-password" id="input-password" value="<?php if(!empty($user[0]['password'])) echo $user[0]['password'];?>" required>
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

		$('#select-roles_id').val('<?php if(!empty($user[0]['rol_id'])) echo $user[0]['rol_id'];?>');
		$('#select-people_id').val('<?php if(!empty($user[0]['people_id'])) echo $user[0]['people_id'];?>');
		$('#select-user_states_id').val('<?php if(!empty($user[0]['user_state_id'])) echo $user[0]['user_state_id'];?>');

	

		$("#form-users").submit(function(event) {
			event.preventDefault();
			$.post(
				site_url + "/CUsers/editUser",{
					id           	: 	'<?php if(!empty($user[0]['id'])) echo $user[0]['id'];?>',
					user 			: 	$("#input-user").val(),
					password 		: 	$("#input-password").val(),
					roles_id 		: 	$("#select-roles_id").val(),
					people_id 		: 	$("#select-people_id").val(),
					user_states_id	: 	$("#select-user_states_id").val(),
					users_save		: 	$("#check-users_save").prop('checked') == true ? '1' : '0',
					users_edit		: 	$("#check-users_edit").prop('checked') == true ? '1' : '0',
					users_delete	: 	$("#check-users_delete:checked").prop('checked') == true ? '1' : '0'
				},
				function(data){
					if (data == 1)
					{
						window.location.replace(site_url+"/CUsers/index");
					}
					else
					{
						alert("Error en el proceso.");
						//window.location.replace(site_url+"/CUsers/edit");
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
