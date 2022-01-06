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
                    					    <i class="fa fa-users"></i>
                    						<h3 class="box-title">Agregar Empresa</h3>
                    						<hr>
                    				  	</div>
                    				  	<form class="form-horizontal" id="form-company">
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
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="city" class="col-sm-2 control-label">Ciudad</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-city" id="input-city">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="commune" class="col-sm-2 control-label">Comuna</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="commune" class="form-control" name="input-commune" id="input-commune">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="companies" class="col-sm-2 control-label">Contacto</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-people" id="select-people" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($people as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->rut; echo '-'.$key->dv; echo $key->name;?></option>
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
	    
	    
	    
	    
		
	</section>

</div>

<?php $this->view('footer'); ?>

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
	    
	    
		$("#form-company").submit(function(event) {
			event.preventDefault();
            
            cuerpo = $('#input-rut').val();
	        dv = cuerpo;
	    
			$.post(
				site_url + "/CCompany/addCompany",{
					rut 				: 	cuerpo,
					dv 					: 	dv,
					razon 				: 	$("#input-razon").val(),
					fantasy 			: 	$("#input-fantasy").val(),
					address 			: 	$("#input-address").val(),
					city 				: 	$("#input-city").val(),
					commune 				: 	$("#input-commune").val(),
					people_id 		: 	$("#select-people").val(),

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

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-company').addClass('menu-open');
      	$('#ul-company').css('display', 'block');
	});

    
</script>
</body>
</html>
