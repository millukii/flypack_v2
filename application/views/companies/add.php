<div class="content-wrapper">
	<section class="content">

	     <div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Agregar Empresa</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">

                            <div class="row">
                    			<div class="col-sm-12">
                    				<div class="box box-success">
                    					<div class="box-header ui-sortable-handle">
										<i class="fa fa-university"></i>
                    						<h3 class="box-title">Agregar Empresa</h3>
                    						<hr>
                    				  	</div>
                    				  	<form class="form-horizontal" id="form-company">
										  <h4>Datos Empresa:</h4>
                    			  			<div class="box-body">
                    			  				<div class="form-group">
                    			  					<label for="rut" class="col-sm-2 control-label">Rut</label>
                    			  					<div class="col-sm-3">

                    			  						<input type="text" class="form-control" name="input-rut" id="input-rut" oninput="checkRut(this)" placeholder="12345678-9" maxlength="10" required>

                    			  						<!--
                    			  						<input type="text" class="form-control" name="input-rut" id="input-rut"  maxlength="10" value="<?php //if(!empty($new_id)) echo $new_id;?>"  disabled required>
														-->
													</div>
                    			  				</div>
                    			  				<div class="form-group">
                    			  					<label for="razon" class="col-sm-2 control-label">Razon Social</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-razon" id="input-razon">
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="fantasy" class="col-sm-2 control-label">Nombre de Fantasia</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-fantasy" id="input-fantasy">
                    			  					</div>
                    			  				</div>

												          <div class="form-group">
                    			  					<label for="prefix" class="col-sm-2 control-label">Prefijo</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-prefix" id="input-prefix" maxlength="5">
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="input-business-email" class="col-sm-2 control-label">Email</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-business-email" id="input-business-email">
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
                    			  					<label for="address" class="col-sm-2 control-label">Dirección Mat.</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address">
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
													<label for="users_state_id" class="col-sm-2 control-label">Ciudad Mat.</label>
													<div class="col-sm-5">
														<select name="select-city" id="select-city" class="form-control" required>
															<option value="">Seleccione una opción</option>
															<?php foreach ($city as $key) {?>
																<option value="<?php echo $key->id; ?>"><?php echo $key->city; ?></option>
															<?php }?>
														</select>
													</div>

													<div class="col-sm-5">
														<button onclick="addUbication();" type="button" class="btn btn-success">
																Otra Ubicación
														</button>
													</div>

												</div>

												<div class="form-group">
													<label for="select-communes" class="col-sm-2 control-label">Comuna Mat.</label>
													<div class="col-sm-5">
														<select name="select-communes" id="select-communes" class="form-control" required>
															<option value="">Seleccione una opción</option>
														</select>
													</div>
												</div>

												<div id="div-ubication" class="col-sm-12">

												</div>
                    			  			</div>
											<hr>

											<div class="box-body">
											<h4>Datos Usuario:</h4>
												<div class="form-group">
													<label for="input-user" class="col-sm-2 control-label">Usuario</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="input-user" id="input-user" required>
													</div>
												</div>

												<div class="form-group">
													<label for="input-password" class="col-sm-2 control-label">Contraseña</label>
													<div class="col-sm-10">
														<input type="password" class="form-control" name="input-password" id="input-password" required>
													</div>
												</div>

												<div class="form-group">
                    			  					<label for="input-name" class="col-sm-2 control-label">Nombre</label>
                    			  					<div class="col-sm-10">
													  <input type="text" class="form-control" name="input-name" id="input-name">
                    			  					</div>
                    			  				</div>

												<div class="form-group">
                    			  					<label for="input-lastname" class="col-sm-2 control-label">Apellido</label>
                    			  					<div class="col-sm-10">
													  <input type="text" class="form-control" name="input-lastname" id="input-lastname">
                    			  					</div>
                    			  				</div>

												<div class="form-group">
                    			  					<label for="input-email" class="col-sm-2 control-label">Email</label>
                    			  					<div class="col-sm-10">
													  <input type="email" class="form-control" name="input-email" id="input-email">
                    			  					</div>
                    			  				</div>

												<div class="form-group">
                    			  					<label for="input-phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-10">
													  <input type="text" class="form-control" name="input-phone" id="input-phone">
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

                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>





	</section>

</div>

<?php $this->view('footer');?>

<script>
	var cuerpo;
	var dv;
	var items_ubication = 0;
  var merchant_id;
	var data_suc = [];

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

  function createMerchant(){
      			$.post(
				site_url + "/CCompany/createQuadminMerchant",
				{
					email: $("#input-business-email").val(),
					name: $("#input-fantasy").val(),
				},
				function(data)
				{
					if (data != null) {
				  	merchant_id = data._id;
            createCompany();
          }	else{
             console.log("merchant creation error.", data);
          }

				}, "json"
			);

  }
  function createCompany(){

			$.post(
				site_url + "/CCompany/addCompany",{
					rut 				: 	cuerpo,
					dv 					: 	dv,
					razon 				: 	$("#input-razon").val(),
					fantasy 			: 	$("#input-fantasy").val(),
					address 			: 	$("#input-address").val(),
					city_id 			: 	$("#select-city").val(),
					communes_id 		: 	$("#select-communes").val(),
					name				:	$('#input-name').val(),
					lastname			:	$('#input-lastname').val(),
					email				:	$('#input-email').val(),
					phone				:	$('#input-phone').val(),
					user				:	$('#input-user').val(),
					password			:	$('#input-password').val(),
					type_rate			:	$('#select-type_rate').val(),
					sucursales			:	data_suc,
          merchant_id: merchant_id,
          business_email: $('#input-business-email').val(),
          prefix: $('#input-prefix').val(),

				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CCompany/index");
					else
						alert("error at company creation .")

				}
			);
  }
	$(document).ready(function()
	{


		$("#form-company").submit(function(event) {
			event.preventDefault();

            cuerpo = $('#input-rut').val();
	        //dv = cuerpo;


			var sucursales_address = document.getElementsByName('input-suc-address');
			var sucursales_city = document.getElementsByName('select-suc-city');
			var sucursales_commune = document.getElementsByName('select-suc-communes');

			for(let i=0; i< sucursales_address.length; i++)
			{
				let suc_address = $(sucursales_address[i]).val();
				let suc_city = $(sucursales_city[i]).val();
				let suc_commune = $(sucursales_commune[i]).val();
				let arr_temp = {'suc_address': suc_address, 'suc_city': suc_city, 'suc_commune': suc_commune};
				data_suc.push(arr_temp);
			}


      //crear merchan en quadmin

      createMerchant();

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

    function addUbication()
	{
		let html = '';
		let c = confirm('Confirme la agregación de otra ciudad y comuna');
		if(c)
		{
			html += '<div id="item-'+items_ubication+'">';

			html += '<div class="form-group">';
			html += '<label for="address" class="col-sm-2 control-label">Dirección Suc '+(items_ubication+1)+' </label>';
			html += '<div class="col-sm-10">';
			html += '<input type="text" class="form-control" name="input-suc-address" id="input-address-'+(items_ubication+1)+'">';
            html += '</div>';
			html += '</div>';

			html += '<div class="form-group">';
			html += '<label for="users_state_id" class="col-sm-2 control-label">Ciudad Suc '+(items_ubication+1)+' </label>';
			html += '<div class="col-sm-5">';
			html += '	<select name="select-suc-city" id="select-city-'+(items_ubication+1)+'" class="form-control" required>';
			html += '		<option value="">Seleccione una opción</option>';
			html += '	</select>';
			html += '</div>';

			html += '<div class="col-sm-5">';
			html += '	<button onclick="removeItem('+items_ubication+');" type="button" class="btn btn-danger">';
			html += '			Quitar';
			html += '	</button>';
			html += '</div>';

			html += '</div>';

			html += '<div class="form-group">';
			html += '<label for="users_state_id" class="col-sm-2 control-label">Comuna Suc '+(items_ubication+1)+' </label>';
			html += '<div class="col-sm-5">';
			html += '	<select name="select-suc-communes" id="select-communes-'+(items_ubication+1)+'" class="form-control" required>';
			html += '		<option value="">Seleccione una opción</option>';
			html += '	</select>';
			html += '</div>';
			html += '</div></div>';

			items_ubication++;
		}

		$('#div-ubication').append(html);

		$('select[name="select-suc-city"]').html($('#select-city').html());

		$('select[name="select-suc-city"]').change(function(){
			let select_id = $(this).attr('id');
			let number_item = select_id.replace('select-city-','');

			$.ajax({
				url: site_url + '/CCompany/getCommunesByCity',
				type: 'post',
				data: {city_id: $(this).val()},
				dataType: 'text',
				success: function(data)
				{
					$('#select-communes-'+number_item).html('<option value="">Seleccione una opción</option>'+data);
				}
			});
		});

	}

	function removeItem(item)
	{
		let c = confirm('Confirme remover este Item Extra.');
		if(c)
		{
			$('#item-'+item).remove();
			items_ubication--;
		}
	}
</script>
</body>
</html>
