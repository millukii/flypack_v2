<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-user"></i>
						<h3 class="box-title">Mi Perfil</h3>
				  	</div>

				  	<form class="form-horizontal" id="updateData">
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
			  					<label for="password" class="col-sm-2 control-label">Nueva</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="password" id="password1" >
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="password" class="col-sm-2 control-label">Repetir</label>
			  					<div class="col-sm-10">
			  						<input type="password" class="form-control" name="password" id="password2" >
			  					</div>
			  				</div>

							<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Nombre</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="name" id="name" value="<?php echo $this->session->userdata('name');?>" >
			  					</div>
			  				</div>

							<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Apellido</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $this->session->userdata('lastname');?>" >
			  					</div>
			  				</div>

							<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Email</label>
			  					<div class="col-sm-10">
			  						<input type="email" class="form-control" name="email" id="email" value="<?php echo $this->session->userdata('email');?>" >
			  					</div>
			  				</div>

							<div class="form-group">
			  					<label for="user" class="col-sm-2 control-label">Teléfono</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $this->session->userdata('phone');?>" >
			  					</div>
			  				</div>
			  				
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
		

		$("#updateData").submit(function(event) {
			event.preventDefault();
			//window.location.replace(site_url+"/Welcome/");

			let password = $('#password').val();
			let password1 = $('#password1').val();
			let password2 = $('#password2').val();
			let name = $('#name').val();
			let lastname = $('#lastname').val();
			let email = $('#email').val();
			let phone = $('#phone').val();

			if(password == '<?php echo $this->session->userdata('password_');?>')
			{
				if(password1 == password2)
				{
					var c = confirm('Confirme la actualización de sus datos.\nRecuerde que posterior a la actualización, la sesión se cerrará.');
					if(c)
					{
						$.ajax({
							url: site_url + "/CWelcome/updateData",
							type: 'post',
							data: {password: password1, name: name, lastname: lastname, email: email, phone: phone},
							dataType: 'text',
							success: function(data)
							{
								window.location.replace(site_url);
							}
						});
					}
					
				}
				else
					alert('La Nueva contraseña no coincide con la repetición para su validación.');
			}
			else
				alert('Debe ingresar su contraseña de usuario para pasar los cambios.');

		});

	});
	
</script>
</body>
</html>
