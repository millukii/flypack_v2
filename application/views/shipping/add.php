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
                    			  						<input type="text" class="form-control" name="input-order-nro" id="input-order-nro"  maxlength="10"  required>
                    			  					</div>
                    			  				</div>
                    
                                    			<div class="form-group">
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Tamaño</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-type" id="select-shipping-type" class="form-control totalAmount" required>
                    			  							<option default value="L">L</option>
                    			  							<option value=M>M</option>
															<option value=L>L</option>
															<option value=XL>XL</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                                    			<div class="form-group">
                    			  					<label for="delivery-options" class="col-sm-2 control-label">Repartidor</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="delivery-options" id="delivery-options" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($delivery_options as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->name; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                                     			<div class="form-group">
                    			  					<label for="total-amount" class="col-sm-2 control-label">Total</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-total-amount" id="input-total-amount" disabled>
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
                    			  						<input type="text" class="form-control" name="input-receiver-phone" id="input-receiver-phone">
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
                    			  						<input type="text" class="form-control" name="input-observation" id="input-observation">
                    			  					</div>
                    			  				</div>

                             
                    			  				<div class="form-group">
                    			  					<label for="origin" class="col-sm-2 control-label">Origen</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-origin" id="select-origin" class="form-control totalAmount" required>
                    			  							<option value="<?php if(!empty($user_company[0]->communes_id)) echo $user_company[0]->communes_id;?>"><?php if(!empty($user_company[0]->commune)) echo $user_company[0]->commune;?></option>
                    			  							<?php foreach ($branch_offices as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="destination" class="col-sm-2 control-label">Destino</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-destination" id="select-destination" class="form-control totalAmount" required >
                    			  							<option value="<?php if(!empty($user_company[0]->communes_id)) echo $user_company[0]->communes_id;?>"><?php if(!empty($user_company[0]->commune)) echo $user_company[0]->commune;?></option>
                    			  							<?php foreach ($communes as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
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
	
	function totalAmount()
	{
		let origin = document.getElementById('select-origin');
		let originSelectedText = origin.options[origin.selectedIndex].text;
		let destination = document.getElementById('select-destination');
		let destinationSelectedText = destination.options[destination.selectedIndex].text;

		$.ajax({
			url: site_url + '/CShipping/getRateFromToCompany',
			type: 'post',
			data: {from: originSelectedText, to: destinationSelectedText},
			success: function(data)
			{
				$('#input-total-amount').val(data);
			}
		});		
    }
	
	$(document).ready(function()
	{
     	totalAmount();

		$('select.totalAmount').on('change', function() {
			totalAmount();
		});

		$("#form-shipping").submit(function(event) 
		{
			event.preventDefault();
            
			cuerpo = $('#input-order_nro').val();
			dv = cuerpo;
	    
			$.post(
				site_url + "/CShipping/addShipping",
				{
					order_nro: $("#input-order-nro").val(),
					quadmins_code: null, // $("#input-quadmins-code").val(),
					total_amount: $("#input-total-amount").val(),
					address: $("#input-address").val(),
					delivery_name: $("#delivery-options").val(),
					shipping_date: $("#input-shipping-date").val(),
					shipping_type: $("#select-shipping-type").val(),
					operation_type: $("#select-operation-type").val(),
					shipping_states_id: $("#select-shipping_states").val(),
					address: $("#input-address").val(),
					receiver_name: $("#input-receiver-name").val(),
					receiver_phone: $("#input-receiver-phone").val(),
					receiver_mail: $("#input-receiver-mail").val(),
					observation: $("#input-observation").val(),
					date: $("#input-shipping-date").val(),
					origin: $('#select-origin').val(),
					destination: $('#select-destination').val()
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CShipping/index");
					else
						alert("Orden existente.", data);
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
