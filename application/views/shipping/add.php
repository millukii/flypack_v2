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
                    			  					<label for="id" class="col-sm-2 control-label">Id</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="text" class="form-control" name="input-id" id="input-id"  maxlength="10" value="<?php if(!empty($new_id)) echo $new_id;?>"  disabled required>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="order_nro" class="col-sm-2 control-label">Numero de Orden</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="text" class="form-control" name="input-order-nro" id="input-order-nro"  maxlength="10"  required>
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
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-type" id="select-shipping-type" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  								<option value=X>X</option>
                                            <option value=L>L</option>
                                            <option value=M>M</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                                      <div class="form-group">
                    			  					<label for="operation-type" class="col-sm-2 control-label">Operación</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-operation-type" id="select-operation-type" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  								<option value=Pedido>Pedido</option>
                                            <option value=Retiro>Retiro</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                                    <div class="form-group">
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Prioridad</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-type" id="select-shipping-type" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  								<option value=0>0</option>
                                            <option value=1>1</option>
                                            <option value=2>2</option>
                                            <option value=3>3</option>
                                            <option value=4>4</option>
                                            <option value=5>5</option>
                                            <option value=6>6</option>
                                            <option value=7>7</option>
                                            <option value=8>8</option>
                                            <option value=9>9</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="total-amount" class="col-sm-2 control-label">Total</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-total-amount" id="input-total-amount">
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
                    			  					<label for="points" class="col-sm-2 control-label">Punto de Interés</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-points" id="select-points" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($points as $key) { ?>
                    			  								<option value="<?php echo $key['code']; ?>"><?php echo $key['address']; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-observation" id="input-observation">
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="select-branch-offices" class="col-sm-2 control-label">Sucursal</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-branch-offices" id="select-branch-offices" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                                          <option value="<?php echo $user_company[0]->id; ?>"><?php echo $user_company[0]->address; ?></option>
                    			  							<?php foreach ($branch_offices as $key) { ?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->address; ?></option>
                    			  							<?php } ?>
                    			  						</select>
                    			  					</div>
                    			  				</div>
                    
                    			  				<div class="form-group">
                    			  					<label for="select-shipping_states" class="col-sm-2 control-label">Estado</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping_states" id="select-shipping_states" class="form-control" required>
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
          id: $("#input-id").val(),
          order_nro: $("#input-order-nro").val(),
          quadmins_code: null, // $("#input-quadmins-code").val(),
          total_amount: $("#input-total-amount").val(),
          address: $("#input-address").val(),
          delivery_name: $("#input-delivery-name").val(),
          origin: $("#select-branch-offices").val(),
          destiny: $("#input-destiny").val(),
          shipping_date: $("#input-shipping-date").val(),
          shipping_type: $("#select-shipping-type").val(),
          operation_type: $("#select-operation-type").val(),
          shipping_states_id: $("#select-shipping_states").val(),
          sender: $("#input-sender").val(),
          address: $("#input-address").val(),
          receiver_name: $("#input-receiver-name").val(),
          receiver_phone: $("#input-receiver-phone").val(),
          receiver_mail: $("#input-receiver-mail").val(),
          observation: $("#input-observation").val(),
          label: $("#input-label").val(),
          poiId: $("#input-poild").val(),
          code: $("#input-quadmins-code").val() ,
          date: $("#input-shipping-date").val(),
          priority: $("#input-priority").val(),
          
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CShipping/index");
					else
						alert("Orden existente.")
					
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
