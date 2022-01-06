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
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Tipo</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-shipping-type" id="input-shipping-type"
                                        value="<?php if(!empty($shipping[0]['shipping_type'])) echo $shipping[0]['shipping_type'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                    
                                     <div class="form-group">
                    			  					<label for="total-amount" class="col-sm-2 control-label">Total</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-total-amount" id="input-total-amount"
                                         value="<?php if(!empty($shipping[0]['total_amount'])) echo $shipping[0]['total_amount'];?>"
                                        >
                    			  					</div>
                    			  				</div>


                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address"
                                        value="<?php if(!empty($shipping[0]['address'])) echo $shipping[0]['address'];?>"
                                        >
                    			  					</div>
                    			  				</div>

                                    <div class="form-group">
                    			  					<label for="origin" class="col-sm-2 control-label">Origin</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-origin" id="input-origin"
                                        value="<?php if(!empty($shipping[0]['origin'])) echo $shipping[0]['origin'];?>"
                                        >
                    			  					</div>
                    			  				</div>

                                    <div class="form-group">
                    			  					<label for="destiny" class="col-sm-2 control-label">Destino</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-destiny" id="input-destiny"
                                        value="<?php if(!empty($shipping[0]['destiny'])) echo $shipping[0]['destiny'];?>"
                                        >
                    			  					</div>
                    			  				</div>

                                     <div class="form-group">
                    			  					<label for="sender" class="col-sm-2 control-label">Emisor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-sender" id="input-sender"
                                        value="<?php if(!empty($shipping[0]['sender'])) echo $shipping[0]['sender'];?>"
                                        >
                    			  					</div>
                                      </div>
                    			  				<div class="form-group">
                    			  					<label for="receiver-name" class="col-sm-2 control-label">Receptor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-receiver-name" id="input-receiver-name"
                                        value="<?php if(!empty($shipping[0]['receiver_name'])) echo $shipping[0]['receiver_name'];?>"
                                        >
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="receiver_phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-receiver-phone" id="input-receiver-phone"
                                        value="<?php if(!empty($shipping[0]['receiver_phone'])) echo $shipping[0]['receiver_phone'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="receiver-mail" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-receiver-mail" id="input-receiver-mail"
                                        value="<?php if(!empty($shipping[0]['receiver_mail'])) echo $shipping[0]['receiver_mail'];?>"
                                        >
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="test" class="form-control" name="input-observation" id="input-observation"
                                        value="<?php if(!empty($shipping[0]['observation'])) echo $shipping[0]['observation'];?>"
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
                    			  					<label for="shipping" class="col-sm-2 control-label">Estado</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-states" id="select-shipping-states" class="form-control" required>
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


		$('#select-shipping-states').val('<?php if(!empty($shipping[0]['shipping_states_id'])) echo $shipping[0]['shipping_states_id'];?>');

    
		$('#select-companies').val('<?php if(!empty($shipping[0]['companies_id'])) echo $shipping[0]['companies_id'];?>');

		$("#form-shipping").submit(function(event) {
			event.preventDefault();
            
			//checkRut(document.getElementById('input-rut'));

            cuerpo = $('#input-rut').val();
	        dv = cuerpo;

			$.post(
				site_url + "/CShipping/editShipping",{
          order_nro: $("#input-order-nro").val(),
          quadmins_code: null,//$("#input-quadmins-code").val(),
          total_amount: $("#input-total-amount").val(),
          address: $("#input-address").val(),
          delivery_name: $("#input-delivery-name").val(),
          shipping_date: $("#input-shipping-date").val(),
          shipping_type: $("#input-shipping-type").val(),
          origin: $("#input-origin").val(),
          destiny: $("#input-destiny").val(),
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
