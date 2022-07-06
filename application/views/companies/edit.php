<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					<i class="fa fa-university"></i>
						<h3 class="box-title">Editar Empresa # <?php if (!empty($company[0]['id'])) {
    echo $company[0]['id'];
}
?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-company">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rut" class="col-sm-2 control-label">Rut</label>
			  					<div class="col-sm-3">
			  					    <!--
			  						<input type="text" class="form-control" name="input-rut" id="input-rut" oninput="checkRut(this)" placeholder="12345678-9" maxlength="10" value="<?php //if(!empty($company[0]['rut'])) echo $company[0]['rut'];?>-<?php //echo $company[0]['dv']; ?>" required>
			  						-->
			  						<input type="text" class="form-control" name="input-rut" id="input-rut"oninput="checkRut(this)" placeholder="12345678-9" maxlength="10" value="<?php if (!empty($company[0]['rut'])) {
    echo $company[0]['rut'] . '-' . $company[0]['dv'];
}
?>"  required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="razon" class="col-sm-2 control-label">Razon Social</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-razon" id="input-razon" value="<?php if (!empty($company[0]['razon'])) {
    echo $company[0]['razon'];
}
?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="fantasy" class="col-sm-2 control-label">Nombre de Fantasia</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-fantasy" id="input-fantasy" value="<?php if (!empty($company[0]['fantasy'])) {
    echo $company[0]['fantasy'];
}
?>">
			  					</div>
			  				</div>

							<div class="form-group">
								<label for="fantasy" class="col-sm-2 control-label">Tipo de Precios</label>
								<div class="col-sm-10">
									<select name="select-type_rate" id="select-type_rate" class="form-control" required>
										<option value="1">Estandar (Origen a Destino)</option>
										<option value="2">Tamaño Paquete</option>
									</select>
								</div>
							</div>
							<div class="form-group">
                  <label for="prefix" class="col-sm-2 control-label">Prefijo</label>
                  <div class="col-sm-10">
                    	<input type="text" class="form-control" name="input-prefix" id="input-prefix" value="<?php if (!empty($company[0]['prefix'])) {echo $company[0]['prefix'];}?>" maxlength="5">
                  </div>
               </div>
			  				<div class="form-group">
			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-address" id="input-address" value="<?php if (!empty($company[0]['address'])) {echo $company[0]['address'];}?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
								<label for="users_state_id" class="col-sm-2 control-label">Ciudad</label>
								<div class="col-sm-5">
									<select name="select-city" id="select-city" class="form-control" required>
										<option value="">Seleccione una opción</option>
										<?php foreach ($city as $key) {?>
											<option value="<?php echo $key->id; ?>"><?php echo $key->city; ?></option>
										<?php }?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="users_state_id" class="col-sm-2 control-label">Comuna</label>
								<div class="col-sm-5">
									<select name="select-communes" id="select-communes" class="form-control" required>
										<option value="">Seleccione una opción</option>
										<?php foreach ($communes as $key) {?>
											<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
										<?php }?>
									</select>
								</div>
							</div>

							<div class="form-group">
			  					<label for="users_state_id" class="col-sm-2 control-label">Estado Empresa</label>
			  					<div class="col-sm-5">
			  						<select name="select-companies_states_id" id="select-companies_states_id" class="form-control" required>
			  							<option value="">Seleccione una opción</option>
			  							<?php foreach ($companies_states as $key) {?>
			  								<option value="<?php echo $key->id; ?>"><?php echo $key->state; ?></option>
			  							<?php }?>
			  						</select>
			  					</div>
			  				</div>

							  	<div class="box-body">
								<h4>Sucursales:</h4>
									<section class="content">

										<table class="table">
											<thead>
												<tr>
													<th>Ciudad</th>
													<th>Comuna</th>
													<th>Dirección</th>
												</tr>
											</thead>
											<tbody>
												<?php
if (!empty($sucursales)) {
    foreach ($sucursales as $key) {?>
													<tr>
														<?php echo '<td>' . $key->city . '</td>';
        echo '<td>' . $key->commune . '</td>';
        echo '<td>' . $key->address . '</td>'; ?>
													</tr>
												<?php }}?>
											</tbody>
										</table>

									</section>
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

<?php $this->view('footer');?>

<script>
	var cuerpo;
	var dv;

	function checkRut(rut) {
	    // Despejar Puntos
	    var valor = rut.value.replace('.','');
	    // Despejar Guión
	    valor = valor.replace('-','');

	    // Aislar Cuerpo y Dígito Verificador
	    cuerpo = valor.slice(0,-1);
	    dv = valor.slice(-1).toUpperCase();

	    // Formatear RUN
	    rut.value = cuerpo + '-'+ dv

	    // Si no cumple con el mínimo ej. (n.nnn.nnn)
	    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}

	    // Calcular Dígito Verificador
	    suma = 0;
	    multiplo = 2;

	    // Para cada dígito del Cuerpo
	    for(i=1;i<=cuerpo.length;i++) {

	        // Obtener su Producto con el Múltiplo Correspondiente
	        index = multiplo * valor.charAt(cuerpo.length - i);

	        // Sumar al Contador General
	        suma = suma + index;

	        // Consolidar Múltiplo dentro del rango [2,7]
	        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

	    }

	    // Calcular Dígito Verificador en base al Módulo 11
	    dvEsperado = 11 - (suma % 11);

	    // Casos Especiales (0 y K)
	    dv = (dv == 'K')?10:dv;
	    dv = (dv == 0)?11:dv;

	    // Validar que el Cuerpo coincide con su Dígito Verificador
	    if(dvEsperado != dv)
	    {
	    	rut.setCustomValidity("RUT Inválido");
	    	return false;
	    }
	    else
	    {
	    	//pequeña validacion
	    	if(dv == 11)
	    		dv = 0;

	    	if(dv == 10)
	    		dv = 'K';
	    }

	    // Si todo sale bien, eliminar errores (decretar que es válido)
	    rut.setCustomValidity('');
	}


	$(document).ready(function()
	{
		$('#select-companies_states_id').val('<?php if (!empty($company[0]['companies_state_id'])) {
    echo $company[0]['companies_state_id'];
}
?>');
		$('#select-type_rate').val('<?php if (!empty($company[0]['type_rate'])) {
    echo $company[0]['type_rate'];
}
?>');

		$('#select-city').val('<?php if (!empty($company[0]['city_id'])) {
    echo $company[0]['city_id'];
}
?>');
		$('#select-communes').val('<?php if (!empty($company[0]['communes_id'])) {
    echo $company[0]['communes_id'];
}
?>');

		$("#form-company").submit(function(event) {
			event.preventDefault();

			//checkRut(document.getElementById('input-rut'));

            cuerpo = $('#input-rut').val();
	        //dv = cuerpo;

			$.post(
				site_url + "/CCompany/editCompany",{
					id    				: 	'<?php if (!empty($company[0]['id'])) {
    echo $company[0]['id'];
}
?>',
					rut 				: 	cuerpo,
					dv 					: 	dv,
					razon 				: 	$("#input-razon").val(),
					fantasy 			: 	$("#input-fantasy").val(),
					address 			: 	$("#input-address").val(),
          prefix 			: 	$("#input-prefix").val(),
					city_id 				: 	$("#select-city").val(),
					communes_id			: 	$("#select-communes").val(),
					companies_states_id	:	$('#select-companies_states_id').val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CCompany/index");
					else
						alert("Rut existente.")
				}
			);
		});

		$('#select-city').change(function(){

			$.ajax({
				url: site_url + '/CCompany/getCommunesByCity',
				type: 'post',
				data: {city_id: $('#select-city').val()},
				dataType: 'text',
				success: function(data)
				{
					$('#select-communes').html('<option value="">Seleccione una opción</option>'+data);
				}
			});
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-company').addClass('menu-open');
      	$('#ul-company').css('display', 'block');
	});

</script>
</body>
</html>
