<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-industry"></i>
						<h3 class="box-title">Editar Cuartel #<?php if(!empty($quarters[0]['id'])) echo $quarters[0]['id'];?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-quarter">

			  			<div class="box-body">

			  				<div class="form-group">
			  					<label for="profile" class="col-sm-2 control-label">Número</label>
			  					<div class="col-sm-10">
			  						<input type="number" class="form-control" name="input-number" id="input-number" value="<?php if(!empty($quarters[0]['number'])) echo $quarters[0]['number'];?>" required>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="profile" class="col-sm-2 control-label">Nombre Cuartel</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-quarter" id="input-quarter" value="<?php if(!empty($quarters[0]['quarter'])) echo $quarters[0]['quarter'];?>" required>
			  					</div>
			  				</div>


			  				<div class="form-group">
			  					<label for="companies" class="col-sm-2 control-label">Huerto</label>
			  					<div class="col-sm-5">
			  						<select name="select-orchards" id="select-orchards" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($orchards as $key) { ?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->orchard; ?></option>
			  							<?php } ?>
			  						</select>
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="companies" class="col-sm-2 control-label">Producto</label>
			  					<div class="col-sm-5">

			  						<?php foreach ($products as $key) { ?>
			  								<?php echo '<input type="checkbox" class="input-check-product" id="'.$key->id.'" />'; ?> <?php echo $key->product.' | '.$key->variety.'<br>'; ?>
			  							<?php } ?>

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

		<?php
			if(!empty($products_quarter))
			{
				foreach($products_quarter as $pq)
				{
					echo '$("#'.$pq['id'].'").attr("checked", true);';
				}
			}
		?>


		$('#select-orchards').val('<?php if(!empty($quarters[0]['orchards_id'])) echo $quarters[0]['orchards_id'];?>');

		$("#form-quarter").submit(function(event) {
			event.preventDefault();

			var products = [];
			var elements_products = document.getElementsByClassName('input-check-product');
			
			for(var i=0; i< elements_products.length;i++)
			{
				if ($(elements_products[i]).is(':checked'))
				{
					products.push($(elements_products[i]).attr('id'));
				}
			}

			$.post(
				site_url + "/CQuarters/editQuarter",{
					id 					: 	'<?php if(!empty($quarters[0]['id'])) echo $quarters[0]['id'];?>',
					number 				: 	$("#input-number").val(),
					quarter 			: 	$("#input-quarter").val(),
					orchards_id 		: 	$("#select-orchards").val(),
					products			: 	products
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CQuarters/index");
					else
						alert("Cuartel existente.")
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
