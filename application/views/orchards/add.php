<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-industry"></i>
						<h3 class="box-title">Agregar Huerto</h3>
				  	</div>

				  	<form class="form-horizontal" id="form-orchards">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Huerto</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-orchard" id="input-orchard" required>
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
		$("#form-orchards").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/COrchards/addOrchard",{
					orchard : 	$("#input-orchard").val()
				},
				function(data)
				{
					if (data == 1) 
						window.location.replace(site_url+"/COrchards/index");
					else
						alert("Huerto existente.");
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-orchards').addClass('menu-open');
      	$('#ul-orchards').css('display', 'block');
	});
</script>
</body>
</html>
