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
                    			  					<label for="select-operation-type" class="col-sm-2 control-label">Tipo de orden</label>
                    			  					<div class="col-sm-2">
                    			  						<select name="select-operation-type" id="select-operation-type" class="form-control " required>
                    			  							<option value="PEDIDO">PEDIDO</option>
                                          <option value="RETIRO">RETIRO</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="input-shipping-date" class="col-sm-2 control-label">Fecha</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="date" class="form-control" name="input-shipping-date" id="input-shipping-date" required value="<?php echo date('Y-m-d'); ?>">
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="order_nro" class="col-sm-2 control-label">Numero de Orden</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="text" class="form-control" name="input-order-nro" id="input-order-nro"  maxlength="10"  required>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="input-packages" class="col-sm-2 control-label">Paquetes extras</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="number" class="form-control" name="input-packages" id="input-packages"  required value="0" min="0">
                    			  					</div>
                    			  				</div>

                                    <div class="form-group selectShippingType onlyPedido">
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
                    			  					<label for="total-amount" class="col-sm-2 control-label">Total</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="text" class="form-control" name="input-total-amount" id="input-total-amount" disabled>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-8">
                    			  						<input type="text" class="form-control" name="input-address" id="input-address" list="list-address" required>
														<datalist id="list-address"></datalist>
													          </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkboxPoid" id="checkboxPoid">
                                    <label class="form-check-label" for="checkboxPoid">
                                      Agregar nueva dirección
                                    </label>
                                  </div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="receiver-name" class="col-sm-2 control-label">Receptor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-receiver-name" id="input-receiver-name" list="list-name" required>
														  <datalist id="list-name"></datalist>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="receiver_phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-receiver-phone" id="input-receiver-phone" required>
                    			  					</div>
                    			  				</div>

                    			  			<div class="form-group">
                    			  					<label for="receiver-mail" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-receiver-mail" id="input-receiver-mail" required>
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-observation" id="input-observation">
                    			  					</div>
                    			  				</div>


                    			  				<div class="form-group selectCommune onlyPedido">
                    			  					<label for="origin" class="col-sm-2 control-label">Origen</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-origin" id="select-origin" class="form-control totalAmount selectCommune" required>
                    			  							<option value="<?php if (!empty($user_company[0]->communes_id)) {
    echo $user_company[0]->communes_id;
}
?>"><?php if (!empty($user_company[0]->commune)) {
    echo $user_company[0]->commune;
}
?></option>
                    			  							<?php foreach ($branch_offices as $key) {?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
                    			  							<?php }?>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group selectCommune onlyPedido">
                    			  					<label for="destination" class="col-sm-2 control-label">Destino</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-destination" id="select-destination" class="form-control totalAmount selectCommune" required >
                    			  							<option value="">SELECCIONE</option>
                    			  							<?php foreach ($communes as $key) {?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
                    			  							<?php }?>
                    			  						</select>
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
	var pois;
  var selectedPoid;
  let merchantId = "<?php print($user_company[0]->merchant_id);?>";

	function getDataPoi(attr, ev){
	  //attr => 1 = address
	  //atte => 2 = receiver_name
	  if(attr == 1)
	  {
		let result = pois.filter(poi => poi.address.toLowerCase().includes(ev.toLowerCase()) );
		let html_option = '';
		if(result.length > 0)
		{
			for(let i=0; i<result.length; i++)
			{
				html_option += '<option>'+result[i]['address']+'</option>';
			}
		}
		$('#list-address').html(html_option);
	  }
	  else if(attr == 2)
	  {
		let result = pois.filter(poi => poi.name.toLowerCase().includes(ev.toLowerCase()) );
		let html_option = '';
		if(result.length > 0)
		{
			for(let i=0; i<result.length; i++)
			{
				html_option += '<option>'+result[i]['name']+'</option>';
			}
		}
		$('#list-name').html(html_option);
	  }
    }

	function getAllPois()
	{
		$.ajax({
        	url: site_url + '/CShipping/getAllPoiData',
          	type: 'post',
          	dataType: 'json',
          	success: function(response){
            	pois = response;
          	}
        });
	}

	function totalAmount()
	{

		let origin = document.getElementById('select-origin');
		let originSelectedText = origin.options[origin.selectedIndex].text;
		let destination = document.getElementById('select-destination');
    let size = document.getElementById('select-shipping-type');
    let sizeSelectedText = size.options[size.selectedIndex].text;
		let destinationSelectedText = destination.options[destination.selectedIndex].text;
    let typeRate = "<?php print($type_rate);?>";

		if (typeRate == "1"){
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

		if (typeRate == "2") {
			$.ajax({
				url: site_url + '/CShipping/getRateSizeCompany',
				type: 'post',
				data: {size: sizeSelectedText},
				success: function(data)
				{
					$('#input-total-amount').val(data);
				}
			});
		}
    }

	function checkExists(inputValue) {

		var x = document.getElementById("list-address");
		var i;
		var flag = false;
		for (i = 0; i < x.options.length; i++) {
			if(inputValue == x.options[i].value){
				flag = true;
				poiObject = pois.find(poi => poi.address.toLowerCase() ==  inputValue.toLowerCase() );

				$('#input-receiver-phone').val(poiObject.phoneNumber);
				$('#input-receiver-mail').val(poiObject.email);
				$('#input-receiver-name').val(poiObject.name);
				$('#input-observation').val(poiObject.poiDeliveryComments);
         		selectedPoid = poiObject._id;
			}

		}

		return flag;
	}

	function checkExists2(inputValue) {

		var x = document.getElementById("list-name");
		var i;
		var flag = false;
		for (i = 0; i < x.options.length; i++) {
			if(inputValue == x.options[i].value){
				flag = true;
				poiObject = pois.find(poi => poi.name.toLowerCase() ==  inputValue.toLowerCase() );

				$('#input-receiver-phone').val(poiObject.phoneNumber);
				$('#input-receiver-mail').val(poiObject.email);
				$('#input-address').val(poiObject.address);
				$('#input-observation').val(poiObject.poiDeliveryComments);
        		selectedPoid = poiObject._id;
			}

		}

		return flag;
	}
  function updatePoid(code) {
      			$.post(
				site_url + "/CShipping/updateQuadminPoid",
				{
					poidCode: code,
					address: $("#input-address").val(),
					receiver_name: $("#input-receiver-name").val(),
					receiver_phone: $("#input-receiver-phone").val(),
					receiver_mail: $("#input-receiver-mail").val(),
					observation: $("#input-observation").val(),
				},
				function(data)
				{
					//if (data != null) {
					//revisar aqui
					//selectedPoid = data._id;
					//}	else{
					//	console.log("poid update error.", data);
					//}
					console.log("poid update error.", data);

				}, "json"
			);
}
function createPoid() {
      			$.post(
				site_url + "/CShipping/createQuadminPoid",
				{
					poidCode: Math.random().toString(36).slice(2, 7),
					address: $("#input-address").val(),
					receiver_name: $("#input-receiver-name").val(),
					receiver_phone: $("#input-receiver-phone").val(),
					receiver_mail: $("#input-receiver-mail").val(),
					observation: $("#input-observation").val(),
				},
				function(data)
				{
					if (data != null) {
					//revisar aqui
					selectedPoid = data._id;
					createOT();
          }	else{
             console.log("poid creation error.", data);
          }

				}, "json"
			);
}

  function createOT(){

      //evaluar si es necesario actualizar la poid
        //1. obtener los input name, address, phone, observation

        var inputAddress =  $("#input-address").val();
        var inputReceiverName = $("#input-receiver-name").val();
        var inputReceiverPhone =  $("#input-receiver-phone").val();
        var inputObservation = $("#input-observation").val();
        var inputReceiverMail =  $("#input-receiver-mail").val();

        //2. obtener datos del poid seleccionado

        var poiObject = pois.find(poi => poi._id ==  selectedPoid);

        //3. comparar cambios

        var updatePoi = false;
        if (poiObject.phoneNumber != inputReceiverPhone){
           updatePoi = true;
        }

        if (poiObject.email != inputReceiverPhone) {
          updatePoi = true;
        }

        if (poiObject.address != inputAddress) {
          updatePoi = true;
        }

        if (poiObject.poiDeliveryComments != inputObservation) {
          updatePoi = true;
        }
        if (poiObject.name != inputReceiverName) {
          updatePoi = true;
        }

        if (updatePoid){
          //actualizar poi a travès del code
          updatePoid(poiObject.code);
        } 

    			$.post(
				site_url + "/CShipping/addShipping",
				{
					order_nro: $("#input-order-nro").val(),
					quadmins_code: null, // $("#input-quadmins-code").val(),
					total_amount: $("#input-total-amount").val(),
					delivery_name: $("#delivery-options").val(),
					shipping_date: $("#input-shipping-date").val(),
					shipping_type: $("#select-shipping-type").val(),
					operation: $("#select-operation-type").val(),
					address: inputAddress ,
					receiver_name: inputReceiverName,
					receiver_phone: inputReceiverPhone,
					receiver_mail: inputReceiverMail,
					observation: inputObservation ,
					origin: $('#select-origin').val(),
          			packages: $("#input-packages").val(),
					destination: $('#select-destination').val(),
					poId: selectedPoid,
					merchant_id: merchantId,
					operation: $("#select-operation-type").val(),
				},
				function(data)
				{
					if (data == 1)
						window.location.replace(site_url+"/CShipping/index");
					else
						alert("Orden existente.");
				}
			);
  }
	$(document).ready(function()
	{

     	totalAmount();
	  	getAllPois();

    $('#select-operation-type').on('change', function() {

		if(this.value == 'PEDIDO')
		{
			$('.onlyPedido').toggle();
			$('.onlyPedido').prop('required',true);

			$('.onlyPedido').css('display','block');
			$('#select-destination').attr('required', true);
		}
		else
		{
			$('.onlyPedido').toggle();
			$('.onlyPedido').prop('required',false);

			$('.onlyPedido').css('display','none');

			$('#select-destination').attr('required', false);
			$('#input-total-amount').val('0');
		}

		if (typeRate == "2") {
			$('.selectCommune').hide();
        	$('.selectCommune').prop('required',false);
      	}

      	if (typeRate == "1") {
			$('.selectShippingType').hide();
        	$('#select-shipping-type').prop('required',false);
      	}
		
	});


      var typeRate = "<?php echo $type_rate; ?>";

      if (typeRate == "2") {
		      $('.selectCommune').hide();
          $('.selectCommune').prop('required',false);
      }

      if (typeRate == "1") {
		      $('.selectShippingType').hide();
          $('#select-shipping-type').prop('required',false);
      }
		$("#input-address").bind('input', function () {
			if(checkExists( $('#input-address').val() ) === true){
				//alert('item selected')
			}
		});

		$("#input-receiver-name").bind('input', function () {
			if(checkExists2( $('#input-receiver-name').val() ) === true){
				//alert('item selected')
			}
		});

		$('#input-address').on('keyup', function() {
			if ($(this).val().length > 3) {
				getDataPoi(1,$(this).val());
			}
		});

    	$('#input-receiver-name').on('keyup', function() {
			if ($(this).val().length > 3) {
				getDataPoi(2, $(this).val());
			}
		});

		$('select.totalAmount').on('change', function() {
			totalAmount();
		});

		$("#form-shipping").submit(function(event)
		{
			event.preventDefault();

			cuerpo = $('#input-order_nro').val();
			dv = cuerpo;

			var newPoi = $('#checkboxPoid').is(':checked');
			if (newPoi) {
				createPoid();
			}else{
				createOT();
			}

		});

		$('#li-configuration').addClass('menu-open');
		$('#ul-configuration').css('display', 'block');
		$('#li-people').addClass('menu-open');
		$('#ul-people').css('display', 'block');
	});
</script>
</body>
</html>
