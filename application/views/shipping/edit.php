<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-rocket"></i>
						<h3 class="box-title">Editar Orden de Transporte # <?php if (!empty($shipping[0]['id'])) {
    echo $shipping[0]['id'];
}
?></h3>
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
                    			  						<input type="date" class="form-control" name="input-shipping-date" id="input-shipping-date"
                                        value="<?php if (!empty($shipping[0]['shipping_date'])) {echo $shipping[0]['shipping_date'];}?>"
                                        min="<?php if (!empty($shipping[0]['shipping_date'])) {echo $shipping[0]['shipping_date'];}?>"
                                        >
                    			  					</div>
                    			  				</div>

                                     <div class="form-group">
                                        <label for="input-order-nro" class="col-sm-2 control-label">Numero de Orden</label>
                                        <div class="col-sm-1">
                                        		<input type="text" class="form-control" name="company-prefix" id="company-prefix"   disabled max="10">
                                        </div>
                                        <div class="col-sm-5">
                                          <input type="text" class="form-control" disabled name="input-order-nro" id="input-order-nro"
                                          value="<?php if (!empty($shipping[0]['order_nro'])) {
    if (str_contains($shipping[0]['order_nro'], "-")) {
        echo explode('-', $shipping[0]['order_nro'])[1];

    } else {
        echo $shipping[0]['order_nro'];
    }

}?>">
                                        </div>
                    			  				</div>

                                     <div class="form-group">
                                        <label for="input-quadmins-code" class="col-sm-2 control-label">Id Quadmins</label>
                                        <div class="col-sm-5">
                                          <input type="number" class="form-control"   disabled name="input-quadmins-code" id="input-quadmins-code"
                                          value="<?php if (!empty($shipping[0]['quadmins_code'])) {echo $shipping[0]['quadmins_code'];}?>"
                                          >
                                        </div>
                    			  				</div>
                    			  				<div class="form-group">
                    			  					<label for="input-packages" class="col-sm-2 control-label">Paquetes</label>
                    			  					<div class="col-sm-3">
                    			  						<input type="number" class="form-control" name="input-packages" id="input-packages"  required value="<?php if (!empty($shipping[0]['packages'])) {echo $shipping[0]['packages'];} else {echo '1';}?>" min="1">
                    			  					</div>
                    			  				</div>

                                    <div class="form-group selectShippingType onlyPedido">
                    			  					<label for="shipping-type" class="col-sm-2 control-label">Tamaño</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-type" id="select-shipping-type" class="form-control totalAmount" required>
                    			  							<option value="<?php if (!empty($shipping[0]['shipping_type'])) {echo $shipping[0]['shipping_type'];}?>"><?php if (!empty($shipping[0]['shipping_type'])) {echo $shipping[0]['shipping_type'];}?></option>
                    			  								<option value=M>M</option>
                                            <option value=L>L</option>
                                            <option value=XL>XL</option>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                                     <div class="form-group">
                    			  					<label for="total-amount" class="col-sm-2 control-label">Total</label>
                    			  					<div class="col-sm-5">
                    			  						<input disabled type="text" class="form-control" name="input-total-amount" id="input-total-amount"
                                         value="<?php if (!empty($shipping[0]['total_amount'])) {echo $shipping[0]['total_amount'];} else {echo '0';}?>">
                    			  					</div>
                    			  				</div>


                    			  				<div class="form-group">
                    			  					<label for="address" class="col-sm-2 control-label">Dirección</label>
                    			  					<div class="col-sm-10">
                                          <input type="text" class="form-control" name="input-address" id="input-address" list="list-address" required value="<?php if (!empty($shipping[0]['address'])) {echo $shipping[0]['address'];}?>">
														            <datalist id="list-address"></datalist>
												            	</div>
                                    </div>
                                     <div class="form-group">
                    			  					<label for="receiver-name" class="col-sm-2 control-label">Receptor</label>
                    			  					<div class="col-sm-10">
                    			  						<input type="text" class="form-control" name="input-receiver-name" id="input-receiver-name" list="list-name" required value="<?php if (!empty($shipping[0]['receiver_name'])) {echo $shipping[0]['receiver_name'];}?>">
														  <datalist id="list-name"></datalist>
                    			  					</div>
                    			  				</div>
                    			  				<div class="form-group">
                    			  					<label for="receiver_phone" class="col-sm-2 control-label">Teléfono</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="text" class="form-control" name="input-receiver-phone" id="input-receiver-phone"
                                        value="<?php if (!empty($shipping[0]['receiver_phone'])) {echo $shipping[0]['receiver_phone'];}?>"
                                        >
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="receiver-mail" class="col-sm-2 control-label">E-mail</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="email" class="form-control" name="input-receiver-mail" id="input-receiver-mail"
                                        value="<?php if (!empty($shipping[0]['receiver_mail'])) {
    echo $shipping[0]['receiver_mail'];
}
?>"
                                        >
                    			  					</div>
                    			  				</div>
                                     <div class="form-group">
                    			  					<label for="observation" class="col-sm-2 control-label">Observacion</label>
                    			  					<div class="col-sm-5">
                    			  						<input type="test" class="form-control" name="input-observation" id="input-observation"
                                        value="<?php if (!empty($shipping[0]['observation'])) {
    echo $shipping[0]['observation'];
}
?>"
                                        >
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group selectCommune onlyPedido">
                    			  					<label for="origin" class="col-sm-2 control-label">Origen</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-origin" id="select-origin" class="form-control totalAmount" required>
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
                    			  						<select name="select-destination" id="select-destination" class="form-control totalAmount" required>
                    			  							<option value="<?php if (!empty($shipping[0]['destination'])) {
    echo $shipping[0]['destination'];
}
?>"><?php if (!empty($shipping[0]['destination'])) {
    echo $shipping[0]['destination'];
}
?></option>
                    			  							<?php foreach ($communes as $key) {?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->commune; ?></option>
                    			  							<?php }?>
                    			  						</select>
                    			  					</div>
                    			  				</div>

                    			  				<div class="form-group">
                    			  					<label for="shipping" class="col-sm-2 control-label">Estado</label>
                    			  					<div class="col-sm-5">
                    			  						<select name="select-shipping-states" id="select-shipping-states" class="form-control" required>
                    			  							<option value="">Seleccione una opción</option>
                    			  							<?php foreach ($shipping_states as $key) {?>
                    			  								<option value="<?php echo $key->id; ?>"><?php echo $key->state; ?></option>
                    			  							<?php }?>
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

<?php $this->view('footer');?>

<script>

	var cuerpo;
	var dv;
	var pois;
  var selectedPoid;

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

	$(document).ready(function()
	{
      var typeRate = "<?php echo $type_rate; ?>";

    $('#select-operation-type').val("<?php echo $shipping[0]['operation']; ?>");
    let prefix = "<?php print($user_company[0]->prefix);?>";
    $('#company-prefix').val(prefix);

        $('#select-operation-type').on('change', function() {

		if(this.value == 'PEDIDO')
		{
			$('.onlyPedido').toggle();
			$('.onlyPedido').prop('required',true);

			$('.onlyPedido').css('display','block');
			$('#select-destination').attr('required', true);

			if (typeRate == "2") {
				$('.selectCommune').hide();
				$('.selectCommune').prop('required',false);
				$('#select-shipping-type').prop('required',true);
			}

			if (typeRate == "1") {
				$('.selectShippingType').hide();
				$('#select-shipping-type').prop('required',false);
				$('.selectCommune').prop('required',true);
			}
		}
		else
		{
			$('.onlyPedido').toggle();
			$('.onlyPedido').prop('required',false);

			$('.onlyPedido').css('display','none');

			$('#select-destination').attr('required', false);
			$('#input-total-amount').val('0');
		}

	});

    totalAmount();
    getAllPois();

      if (typeRate == "2") {
		      $('.selectCommune').hide();
          $('.selectCommune').prop('required',false);
      }

      if (typeRate == "1") {
		      $('.selectShippingType').hide();
          $('.selectShippingType').prop('required',false);
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

		$("#select-origin option").filter(function() {
			return $(this).text() == '<?php if (!empty($shipping[0]['origin'])) {
    echo $shipping[0]['origin'];
} else {
    echo 1;
}
?>';
		}).prop('selected', true);

		$("#select-destination option").filter(function() {
			return $(this).text() == '<?php if (!empty($shipping[0]['destination'])) {
    echo $shipping[0]['destination'];
} else {
    echo 1;
}
?>';
		}).prop('selected', true);

		$("#select-delivery option").filter(function() {
			return $(this).text() == '<?php if (!empty($shipping[0]['delivery_name'])) {
    echo $shipping[0]['delivery_name'];
} else {
    echo 1;
}
?>';
		}).prop('selected', true);

		$('#select-shipping-states').val(<?php if (!empty($shipping[0]['shipping_states_id'])) {
    echo $shipping[0]['shipping_states_id'];
}
?>);

	function totalAmount()
	{
		let origin = document.getElementById('select-origin');
		let originSelectedText = origin.options[origin.selectedIndex].text;
		let destination = document.getElementById('select-destination');
    	let size = document.getElementById('select-shipping-type');
    	let sizeSelectedText = size.options[size.selectedIndex].text;
		let destinationSelectedText = destination.options[destination.selectedIndex].text;

    	let typeRate = "<?php print($type_rate);?>";

		let extraPackges = parseInt($('#input-packages').val());

		if (typeRate == "1"){
			$.ajax({
				url: site_url + '/CShipping/getRateFromToCompany',
				type: 'post',
				data: {from: originSelectedText, to: destinationSelectedText},
				success: function(data)
				{
					if(extraPackges == 1 || extraPackges == '')
						data = parseInt(data);
					else if(extraPackges == 2)
						data = parseInt(data) + 1600;
					else if(extraPackges > 2)
						data = parseInt(data) + ((extraPackges - 1) * 1000);

					data = Math.round(data);
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
				if(extraPackges == 1 || extraPackges == '')
					data = parseInt(data);
				else if(extraPackges == 2)
					data = parseInt(data) + parseInt(data * 0.6);
				else if(extraPackges > 2)
					data = parseInt(data) + ((extraPackges - 1) * 0.4 * data);

				data = Math.round(data);
				$('#input-total-amount').val(data);
			}
			});
		}

    }

    $('select.totalAmount').on('change', function() {
      totalAmount();
    });




		$('#select-companies').val('<?php if (!empty($shipping[0]['companies_id'])) {
    echo $shipping[0]['companies_id'];
}
?>');

		$("#form-shipping").submit(function(event) {
			event.preventDefault();

			//checkRut(document.getElementById('input-rut'));

            cuerpo = $('#input-rut').val();
	        dv = cuerpo;

			$.ajax({
				url: site_url + "/CShipping/editShipping",
				type: 'post',
				data:
				{
					id: <?php if (!empty($_GET['id'])) {echo $_GET['id'];}?>,
					order_nro: $('#company-prefix').val()+'-'+$("#input-order-nro").val(),
					quadmins_code:  $("#input-quadmins-code").val(),
          			shipping_date: $("#input-shipping-date").val(),
					total_amount: $("#input-total-amount").val(),
					address: $("#input-address").val(),
					delivery_name: $("#select-delivery").val(),
					shipping_type: $("#select-shipping-type").val(),
					origin: $("#select-origin").val(),
					destination: $("#select-destination").val(),
					shipping_states_id: $("#select-shipping-states").val(),
					receiver_name: $("#input-receiver-name").val(),
					receiver_phone: $("#input-receiver-phone").val(),
					receiver_mail: $("#input-receiver-mail").val(),
					observation: $("#input-observation").val(),
					packages: $("#input-packages").val(),
					poId: selectedPoid,
					operation: $("#select-operation-type").val(),
				},
				success: function(data)
				{

					if (data == 1)
						window.location.replace(site_url+"/CShipping/index");
					else
						alert("Error.");

				}
			});
		});

		//paquetes extras
		$('#input-packages').on('keyup', function() {
			totalAmount();
		});

		$('#input-packages').on('change', function() {
			totalAmount();
		});

		$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-shipping').addClass('menu-open');
      	$('#ul-shipping').css('display', 'block');
	});

</script>
</body>
</html>
