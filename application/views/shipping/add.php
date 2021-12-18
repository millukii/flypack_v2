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
                    			  					<label for="sender" class="col-sm-2 control-label">Emisor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-sender" id="input-sender">
                    			  					</div>
                                      </div>
                                     <div class="form-group">
                    			  					<label for="receiver-name" class="col-sm-2 control-label">Receptor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-receiver-name" id="input-receiver-name">
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
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="test" class="form-control" name="input-observation" id="input-observation">
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

	
	$(document).ready(function()
	{
		$("#form-shipping").submit(function(event) {
			event.preventDefault();
            
            cuerpo = $('#input-order_nro').val();
	        dv = cuerpo;
	    
			$.post(
				site_url + "/CShipping/addShipping",{
          order_nro: $("#input-order-nro").val(),
          quadmins_code: $("#input-quadmins-code").val(),
          total_amount: $("#input-total-amount").val(),
          address: $("#input-address").val(),
          delivery_name: $("#input-delivery-name").val(),
          shipping_date: $("#input-shipping-date").val(),
          shipping_type: $("#input-shipping-type").val(),
          companies_id: $("#input-company").val(),
          shipping_states_id: $("#input-shipping-state").val(),
          sender: $("#input-sender").val(),
          address: $("#input-address").val(),
          receiver_name: $("#input-receiver-name").val(),
          receiver_phone: $("#input-receiver-phone").val(),
          receiver_mail: $("#input-receiver-mail").val(),
          observation: $("#input-observation").val(),
          label: $("#input-label").val(),
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
