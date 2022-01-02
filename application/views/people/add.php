<div class="content-wrapper">
	<section class="content">
	    
	     <div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Agregar Persona</a></li>
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
                    						<h3 class="box-title">Agregar Persona</h3>
                    						<hr>
                    				  	</div>
                    				  	<form class="form-horizontal" id="form-people">
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
                    			  					<label for="name" class="col-sm-2 control-label">Nombres</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-name" id="input-name">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="last_name" class="col-sm-2 control-label">Apellidos</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-lastname" id="input-lastname">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="number" class="form-control" name="input-phone" id="input-phone">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="email" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-email" id="input-email">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="companies" class="col-sm-2 control-label">Perfil</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-profiles" id="select-profiles" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($profiles as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->profile; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="people" class="col-sm-2 control-label">Estado</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-people_states" id="select-people_states" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($people_states as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->state; ?></option>
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
	    
	    
		$("#form-people").submit(function(event) {
			event.preventDefault();
            
            cuerpo = $('#input-rut').val();
	        dv = cuerpo;
	    
			$.post(
				site_url + "/CPeople/addPeople",{
					rut 				: 	cuerpo,
					dv 					: 	dv,
					name 				: 	$("#input-name").val(),
					lastname 			: 	$("#input-lastname").val(),
					address 			: 	$("#input-address").val(),
					email 				: 	$("#input-email").val(),
					phone 				: 	$("#input-phone").val(),
					profiles_id 		: 	$("#select-profiles").val(),
					people_states_id	:   $('#select-people_states').val(),
					contractor			:	$("#select-contractor").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CPeople/index");
					else
						alert("Rut existente.")
					
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-people').addClass('menu-open');
      	$('#ul-people').css('display', 'block');
	});

    function generateMasive()
    {
        var quantity_workers = parseInt($('#input-quantity_workers').val().trim());
        var contractor = $('#select-contractor_masive').val();
        var c = confirm('Confirme la generación de '+quantity_workers+' registros de cosecheros adicionales.');
        if(c)
        {
            $.ajax({
                url: site_url+'/CPeople/generateMasive',
                type: 'post',
                dataType: 'text',
                data: {quantity_workers: quantity_workers, contractor: contractor},
                success: function(data)
                {
                    if(data == 1)
                    {
                        alert('Generados correctamente.');
                        window.location.replace(site_url+"/CPeople/index");
                    }
                    else
                        alert('No se han podido generar los registros de cosecheros adicionales.');
                }
            });
        }
        
    }
    
</script>
</body>
</html>
