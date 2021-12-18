<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-user"></i>
						<h3 class="box-title">Mi Perfil</h3>
				  	</div>

				  	<form class="form-horizontal" id="changePassword">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Usuario</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="user" id="user" value="<?php echo $this->session->userdata('user');?>" readonly>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Contraseña Actual</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="password" id="password" required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Nueva Actual</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="password" id="password1" required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Repetir Actual</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="password" id="password2" required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="roles_id" class="col-sm-2 control-label">Rol</label>
			  					<div class="col-sm-5">
			  						<select name="roles_id" id="roles_id" class="form-control" disabled>
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
			  						<select name="people_id" id="people_id" class="form-control" disabled>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($people as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->name." ".$key->last_name; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="users_state_id" class="col-sm-2 control-label">Estado usuario</label>
			  					<div class="col-sm-5">
			  						<select name="users_state_id" id="users_state_id" class="form-control" disabled>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($users_state as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->state; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>
			  				<!--  -->
			  				<div class="form-group">
			  					<label class="col-sm-2 control-label">
			  						Permitido
			  					</label>
			  					<div class="checkbox col-sm-5">
			  						<label>
			  							<input type="checkbox" id="users_save" disabled> Crear
			  						</label>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label class="col-sm-2 control-label">
			  						Permitido
			  					</label>
			  					<div class="checkbox col-sm-5">
			  						<label>
			  							<input type="checkbox" id="users_edit" disabled> Editar
			  						</label>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label class="col-sm-2 control-label">
			  						Permitido
			  					</label>
			  					<div class="checkbox col-sm-5">
			  						<label>
			  							<input type="checkbox" id="users_del" disabled> Eliminar
			  						</label>
			  					</div>
			  				</div>
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

		$("#roles_id").val(<?php echo $this->session->userdata('roles_id') ?>)
		$("#people_id").val(<?php echo $this->session->userdata('people_id') ?>)

		if ('<?php echo $this->session->userdata('state') ?>' == 'Activo') {
			$("#users_state_id").val('1')
		}
		else {
			$("#users_state_id").val('2')
		}

		if (<?php echo $this->session->userdata('save') ?> == 1) {
			$("#users_save").prop('checked', true)
		}
		else {
			$("#users_save").prop('checked', false) 
		}
		
		if (<?php echo $this->session->userdata('edit') ?> == 1) {
			$("#users_edit").prop('checked', true)
		}
		else {
			$("#users_edit").prop('checked', false) 
		}

		if (<?php echo $this->session->userdata('del') ?> == 1) {
			$("#users_del").prop('checked', true)
		}
		else {
			$("#users_del").prop('checked', false) 
		}
		

		$("#changePassword").submit(function(event) {
			event.preventDefault();

			if ($("#password1").val() === $("#password2").val()) {
				$.ajax({
					url: site_url + "/Welcome/changePassword",
					type: 'POST',
					dataType: 'json',
					data: {
						passv 	: 	$("#password").val(),
						passn 	: 	$("#password1").val(),
					},
					success: function(data){
						if (data == 1) {
							window.location.replace(site_url+"/Welcome/");
						}
						else {
							alert("Error en el proceso...")
							window.location.replace(site_url+"/Welcome");
						}
					}
				});
			}
			else {
				alert("Las contraseñas nuevas no coinciden");
				$("#password1").val('');
				$("#password2").val('');
			}	

			
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

		$('#li-users').addClass('menu-open');
		$('#ul-users').css('display', 'block');
	});
</script>
</body>
</html>
