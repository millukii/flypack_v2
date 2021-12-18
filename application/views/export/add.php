<div class="content-wrapper">
	<section class="content">
        <div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Agregar Back-Up SQL</h3>
						<hr>
				  	</div>
				  	<form class="form-horizontal" id="form-exports">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rut" class="col-sm-2 control-label">Nombre Back-Up</label>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="input-name" id="input-name"  value=""   required>
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
	    
		$("#form-exports").submit(function(event) {
			event.preventDefault();
            
	        var c = confirm('Confirme la creación del proceso de Back-Up.\nPara este proceso solo se guardarán los datos contenidos a la fecha de HOY, en adelante se reiniciarán los datos de las tablas de Transacciones.');
	        if(c)
	        {
	            $.post(
    				site_url + "/CExportSQL/add_export_sql",{
    					name 				: 	$('#input-name').val().trim()
    				},
    				function(data)
    				{
    					if (data == 1)
    						window.location.replace(site_url+"/CExportSQL/index");
    					else
    						alert("Error en el proceso de Back-Up.")
    					
    				}
    			);
	        }
			
		});

		$('#li-utils').addClass('menu-open');
        $('#ul-utils').css('display', 'block');
	});

</script>
</body>
</html>
