<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-balance-scale "></i>
						<h3 class="box-title">Editar Unidad de Medida #<?php if(!empty($unit[0]['id']))echo $unit[0]['id']; ?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-units">

			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Unidad de Medida</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-unit" id="input-unit" required value="<?php if(!empty($unit[0]['unit']))echo $unit[0]['unit']; ?>">
			  					</div>
			  				</div>
			  			</div>

			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Acrónimo</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-acronym" id="input-acronym" required value="<?php if(!empty($unit[0]['acronym']))echo $unit[0]['acronym']; ?>">
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
		$("#form-units").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CUnits/editUnit",{
					id 		: 	<?php echo $unit[0]['id']; ?>,
					unit : 	$("#input-unit").val(),
					acronym : $('#input-acronym').val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CUnits/index");
					else 
						alert("Unidad de Medida existente.");
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');
      	
		$('#li-containers').addClass('menu-open');
      	$('#ul-containers').css('display', 'block');
	});
	
</script>
</body>
</html>
