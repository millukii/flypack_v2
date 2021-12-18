<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Editar Orden de Transporte # <?php if(!empty($shipping[0]['id'])) echo $shipping[0]['id'];?></h3>
				  	</div>
                    				  	<form class="form-horizontal" id="form-shipping">
                    			  			<div class="box-body">
                    			  				<div class="form-group">
                    			  					<label for="order_nro" class="col-sm-2 control-label">Numero de Orden</label>
                    			  					<div class="col-sm-3">

                    			  						<input type="text" class="form-control" name="input-order_nro" id="input-order_nro"  maxlength="10" value="<?php if(!empty($shipping[0]['order_nro'])) echo $shipping[0]['order_nro'];?>"   disabled required>
                    			  					</div>
                    			  				</div>
                    			  				<div class="form-group">
                    			  					<label for="quadmins-code" class="col-sm-2 control-label">Codigo Quadmin</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-quadmins-code" id="input-quadmins-code"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>" 
                                        >
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Tipo</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-shipping-type" id="input-shipping-type"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="sender" class="col-sm-2 control-label">Emisor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-sender" id="input-sender"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                                      </div>
                    			  				<div class="form-group">
                    			  					<label for="receiver-name" class="col-sm-2 control-label">Receptor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="number" class="form-control" name="input-receiver-name" id="input-receiver-name"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="receiver_phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="number" class="form-control" name="input-receiver-phone" id="input-receiver-phone"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="receiver-mail" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-receiver-mail" id="input-receiver-mail"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="test" class="form-control" name="input-observation" id="input-observation"
                                        value="<?php if(!empty($shipping[0]['quadmins_code'])) echo $shipping[0]['quadmins_code'];?>"
                                        >
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
                                      <a href="<?php echo site_url(); ?>/CShipping/index" class="btn btn-primary pull-right" role="button">
                                      <i class='fa fa-undo'></i> Volver
                                    </a>
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

	$(document).ready(function()
	{


		$('#select-shipping_states').val('<?php if(!empty($shipping[0]['shipping_states_id'])) echo $shipping[0]['shipping_states_id'];?>');

    
		$('#select-companies').val('<?php if(!empty($shipping[0]['company'])) echo $shipping[0]['company'];?>');

		$("#form-shipping").submit(function(event) {
			event.preventDefault();
            
			//checkRut(document.getElementById('input-rut'));

            cuerpo = $('#input-rut').val();
	        dv = cuerpo;

			$.post(
				site_url + "/CShipping/editShipping",{
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

      	$('#li-shipping').addClass('menu-open');
      	$('#ul-shipping').css('display', 'block');
	});

</script>
</body>
</html>
