<div class="content-wrapper">
	<section class="content">
	    
	     <div class="row">
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Agregar Orden de Transporte</a></li>
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
                    						<h3 class="box-title">Agregar Orden de Transporte</h3>
                    						<hr>
                    				  	</div>
                    				  	<form class="form-horizontal" id="form-shipping">
                    			  			<div class="box-body">
                    			  				<div class="form-group">
                    			  					<label for="order_nro" class="col-sm-2 control-label">Numero de Orden</label>
                    			  					<div class="col-sm-3">

                    			  						<input type="text" class="form-control" name="input-order_nro" id="input-order_nro"  maxlength="10" value="<?php if(!empty($new_id)) echo $new_id;?>"  disabled required>
                    			  					</div>
                    			  				</div>
                    			  				<div class="form-group">
                    			  					<label for="quadmins-code" class="col-sm-2 control-label">Codigo Quadmin</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-quadmins-code" id="input-quadmins-code">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Tipo</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-shipping-type" id="input-shipping-type">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="receiver_phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="number" class="form-control" name="input-receiver-phone" id="input-receiver-phone">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="receiver-mail" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-receiver-mail" id="input-receiver-mail">
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="companies" class="col-sm-2 control-label">Empresa</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-companies" id="select-companies" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($companies as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->razon; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="people" class="col-sm-2 control-label">Estado</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-people_states" id="select-people_states" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($shipping_states as $key) { ?>
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
		$("#form-shipping").submit(function(event) {
			event.preventDefault();
            
            cuerpo = $('#input-order_nro').val();
	        dv = cuerpo;
	    
			$.post(
				site_url + "/CShipping/addShipping",{
					rut 				: 	cuerpo,
					dv 					: 	dv,
					name 				: 	$("#input-quadmins-code").val(),
					lastname 			: 	$("#input-shipping-type").val(),
					address 			: 	$("#input-address").val(),
					email 				: 	$("#input-receiver-mail").val(),
					phone 				: 	$("#input-receiver-phone").val(),
					companies_id 		: 	$("#select-companies").val(),
					people_states_id	:   $('#select-people_states').val(),
					contractor			:	$("#select-contractor").val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CShipping/index");
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
                url: site_url+'/CShipping/generateMasive',
                type: 'post',
                dataType: 'text',
                data: {quantity_workers: quantity_workers, contractor: contractor},
                success: function(data)
                {
                    if(data == 1)
                    {
                        alert('Generados correctamente.');
                        window.location.replace(site_url+"/CShipping/index");
                    }
                    else
                        alert('No se han podido generar los registros de ordenes de transporte adicionales.');
                }
            });
        }
        
    }
    
</script>
</body>
</html>
