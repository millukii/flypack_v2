<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Agregar Rol</h3>
				  	</div>

				  	<form class="form-horizontal" id="form-roles">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Rol</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-rol" id="input-rol" required>
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
		$("#form-roles").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CRoles/addRol",{
					rol : 	$("#input-rol").val()
				},
				function(data)
				{
					if (data == 1) 
						window.location.replace(site_url+"/CRoles/index");
					else
						alert("Rol existente.");
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
