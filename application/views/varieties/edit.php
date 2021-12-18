<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-cart-plus"></i>
						<h3 class="box-title">Editar Variedad #<?php if(!empty($variety[0]['id']))echo $variety[0]['id']; ?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-varieties">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rol" class="col-sm-2 control-label">Variedad</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-variety" id="input-variety" required value="<?php if(!empty($variety[0]['variety']))echo $variety[0]['variety']; ?>">
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
		$("#form-varieties").submit(function(event) {
			event.preventDefault();

			$.post(
				site_url + "/CVarieties/editVariety",{
					id 		: 	'<?php echo $variety[0]['id']; ?>',
					variety : 	$("#input-variety").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CVarieties/index");
					else 
						alert("Variedad existente.");
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
