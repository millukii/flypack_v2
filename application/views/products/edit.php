<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-cart-plus"></i>
						<h3 class="box-title">Editar Producto #<?php if(!empty($product[0]['id'])) echo $product[0]['id'];?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-products">

			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Producto</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-product" id="input-product" value="<?php if(!empty($product[0]['product'])) echo $product[0]['product'];?>" required>
			  					</div>
			  				</div>
			  			</div>

			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Descripción</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-description" id="input-description" value="<?php if(!empty($product[0]['description'])) echo $product[0]['description'];?>" required>
			  					</div>
			  				</div>
			  			</div>

			  			<div class="form-group">
			  					<label for="companies" class="col-sm-2 control-label">Variedad</label>
			  					<div class="col-sm-5">
			  						<select name="select-varieties" id="select-varieties" class="form-control"  required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($varieties as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->variety; ?></option>
			  							<?php } ?>
			  						</select>
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

		$('#select-varieties').val('<?php if(!empty($product[0]['varieties_id'])) echo $product[0]['varieties_id'];?>');

		$("#form-products").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CProducts/editProduct",{
					id 				: '<?php if(!empty($product[0]['id'])) echo $product[0]['id'];?>',
					product 		: 	$("#input-product").val(),
					description 	: $('#input-description').val(),
					varieties_id	: $('#select-varieties').val()
				},
				function(data)
				{
					if (data == 1) 
						window.location.replace(site_url+"/CProducts/index");
					else
						alert("Producto existente.");
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
