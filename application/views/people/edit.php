<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Editar Persona # <?php if(!empty($people[0]['id'])) echo $people[0]['id'];?></h3>
				  	</div>

				  	<form class="form-horizontal" id="form-people">
			  			<div class="box-body">
			  				<div class="form-group">
			  					<label for="rut" class="col-sm-2 control-label">Rut</label>
			  					<div class="col-sm-3">
			  					    <!--
			  						<input type="text" class="form-control" name="input-rut" id="input-rut" oninput="checkRut(this)" placeholder="12345678-9" maxlength="10" value="<?php //if(!empty($people[0]['rut'])) echo $people[0]['rut'];?>-<?php //echo $people[0]['dv']; ?>" required>
			  						-->
			  						<input type="text" class="form-control" name="input-rut" id="input-rut" maxlength="10" value="<?php if(!empty($people[0]['rut'])) echo $people[0]['rut'];?>" disabled required>
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="name" class="col-sm-2 control-label">Nombres</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-name" id="input-name" value="<?php if(!empty($people[0]['name'])) echo $people[0]['name'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="last_name" class="col-sm-2 control-label">Apellidos</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-lastname" id="input-lastname" value="<?php if(!empty($people[0]['lastname'])) echo $people[0]['lastname'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-address" id="input-address" value="<?php if(!empty($people[0]['address'])) echo $people[0]['address'];?>">
			  					</div>
			  				</div>
			  				<div class="form-group">
			  					<label for="city" class="col-sm-2 control-label">Ciudad</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-city" id="input-city" value="<?php if(!empty($people[0]['city'])) echo $people[0]['city'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="commune" class="col-sm-2 control-label">Comuna</label>
			  					<div class="col-sm-10">
			  						<input type="text" class="form-control" name="input-commune" id="input-commune" value="<?php if(!empty($people[0]['commune'])) echo $people[0]['commune'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="phone" class="col-sm-2 control-label">Teléfono</label>
			  					<div class="col-sm-5">
			  						<input type="text" class="form-control" name="input-phone" id="input-phone" value="<?php if(!empty($people[0]['phone'])) echo $people[0]['phone'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="email" class="col-sm-2 control-label">E-mail</label>
			  					<div class="col-sm-5">
			  						<input type="email" class="form-control" name="input-email" id="input-email" value="<?php if(!empty($people[0]['email'])) echo $people[0]['email'];?>">
			  					</div>
			  				</div>

			  				<div class="form-group">
			  					<label for="profiles" class="col-sm-2 control-label">Perfil</label>
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

		$('#select-profiles').val('<?php if(!empty($people[0]['profiles_id'])) echo $people[0]['profiles_id'];?>');
		$('#select-people_states').val('<?php if(!empty($people[0]['people_states_id'])) echo $people[0]['people_states_id'];?>');

		$("#form-people").submit(function(event) {
			event.preventDefault();
            
			//checkRut(document.getElementById('input-rut'));

            cuerpo = $('#input-rut').val();
	        dv = cuerpo;

			$.post(
				site_url + "/CPeople/editPeople",{
					id    				: 	'<?php if(!empty($people[0]['id'])) echo $people[0]['id'];?>',
					rut 				: 	cuerpo,
					dv 					: 	dv,
					name 				: 	$("#input-name").val(),
					lastname 			: 	$("#input-lastname").val(),
					address 			: 	$("#input-address").val(),
					email 				: 	$("#input-email").val(),
					phone 				: 	$("#input-phone").val(),
          commune 				: 	$("#input-commune").val(),
          city 				: 	$("#input-city").val(),
					profiles_id 		: 	$("#select-profiles").val(),
					people_states_id	:   $('#select-people_states').val(),
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CPeople/index");
					else
						alert("Error actualizando.")
				}
			);
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-people').addClass('menu-open');
      	$('#ul-people').css('display', 'block');
	});

</script>
</body>
</html>
