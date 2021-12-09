<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-suitcase"></i>
						<h3 class="box-title">Editar Contenedor # <?php if(!empty($container[0]["id"])) echo $container[0]["id"];?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-containers">
			  			<div class="box-body">

			  				<div class="form-group">
			  					<label for="rut" class="col-sm-2 control-label">Contenedor</label>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="input-container" id="input-container" value="<?php if(!empty($container[0]["container"])) echo $container[0]["container"];?>" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="name" class="col-sm-2 control-label">Peso</label>
			  					<div class="col-sm-10">
			  						<input type="number" class="form-control" name="input-weight" id="input-weight" value="<?php if(!empty($container[0]["weight"])) echo $container[0]["weight"];?>" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="companies" class="col-sm-2 control-label">Unidad de Medida</label>
			  					<div class="col-sm-5">
			  						<select name="select-units" id="select-units" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($units as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->acronym.' | '.$key->unit; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="name" class="col-sm-2 control-label">Valor Pago $</label>
			  					<div class="col-sm-10">
			  						<input type="number" class="form-control" name="input-value_payment" id="input-value_payment" value="<?php if(!empty($container[0]["value_payment"])) echo $container[0]["value_payment"];?>" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="name" class="col-sm-2 control-label">Valor Venta $</label>
			  					<div class="col-sm-10">
			  						<input type="number" class="form-control" name="input-value_sale" id="input-value_sale" value="<?php if(!empty($container[0]["value_sale"])) echo $container[0]["value_sale"];?>" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="companies" class="col-sm-2 control-label">Producto</label>
			  					<div class="col-sm-5">
			  						<select name="select-products" id="select-products" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($products as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->product.' | '.$key->variety; ?></option>
			  							<?php } ?>
			  						</select>
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

	$(document).ready(function()
	{
		$('#select-units').val('<?php if(!empty($container[0]["units_id"])) echo $container[0]["units_id"];?>');
		$('#select-products').val('<?php if(!empty($container[0]["products_id"])) echo $container[0]["products_id"];?>');

		$("#form-containers").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CContainers/editContainer",{
					id 					: 	'<?php if(!empty($container[0]["id"])) echo $container[0]["id"];?>',
					container 			: 	$("#input-container").val(),
					products_id 		: 	$("#select-products").val(),
					weight 				: 	$("#input-weight").val(),
					units_id 			: 	$("#select-units").val(),
					value_payment 		: 	$("#input-value_payment").val(),
					value_sale 			: 	$("#input-value_sale").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CContainers/index");
					else
						alert("Contenedor existente.")
					
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
