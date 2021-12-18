<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-cog"></i>
						<h3 class="box-title">Editar Proceso #<?php if(!empty($process[0]['id']))echo $process[0]['id']; ?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-process">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Proceso</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-process" id="input-process" required value="<?php if(!empty($process[0]['process']))echo $process[0]['process']; ?>">
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
		$("#form-process").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CProcess/editProcess",{
					id 		: 	<?php echo $process[0]['id']; ?>,
					process : 	$("#input-process").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CProcess/index");
					else 
						alert("Proceso existente.");
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');
      	
		$('#li-process').addClass('menu-open');
		$('#ul-process').css('display', 'block');
	});
	
</script>
</body>
</html>
