<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Agregar Perfil</h3>
				  	</div>

				  	<form class="form-horizontal" id="form-profile">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="profile" class="col-sm-2 control-label">Perfil</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-profile" id="input-profile" required>
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
		$("#form-profile").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CProfiles/addProfile",{
					profile : 	$("#input-profile").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CProfiles/index");
					else
						alert("Profile existente.")
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-people').addClass('menu-open');
      	$('#ul-people').css('display', 'block');
	});
</script>
</body>
</html>
