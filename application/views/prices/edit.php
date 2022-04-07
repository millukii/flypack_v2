<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Editar Precio #<?php if(!empty($prices[0]['id']))echo $prices[0]['id']; ?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-prices">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="value" class="col-sm-2 contvalue-label">Precio</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-contvalue" name="input-value" id="input-value" required value="<?php if(!empty($prices[0]['value']))echo $prices[0]['value']; ?>">
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
		$("#form-prices").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CPrices/editPrice",{
					id 		: 	<?php echo $prices[0]['id']; ?>,
					companies_id: <?php echo $_GET['companies_id']; ?>,
					value : 	$("#input-value").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CPrices/index");
					else 
						alert("Precio existente.");
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
