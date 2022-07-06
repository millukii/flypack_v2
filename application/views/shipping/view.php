<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-users"></i>
						<h3 class="box-title">Orden de Transporte</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if (!empty($shipping[0]['id'])) {
    echo $shipping[0]['id'];
}
?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Orden</th>
		  			    				<td><?php if (!empty($shipping[0]['order_nro'])) {
    echo $shipping[0]['order_nro'];
}
?></td>
		  		    		    	</tr>
		  		    	    		<tr>
		  		    	    			<th>Tipo de Envio</th>
		  		    	    			<td><?php if (!empty($shipping[0]['shipping_type'])) {echo $shipping[0]['shipping_type'];}?></td>
		  		    	    		</tr>
		  		    	    		<tr>
                          <th>Total</th>
                              <td><?php if (!empty($shipping[0]['total_amount'])) {echo $shipping[0]['total_amount'];} else {echo '0';}?>
                              </td>
                          </tr>
                          <tr>
                          <th>Repartidor</th>
                              <td><?php if (!empty($shipping[0]['delivery_name'])) {echo $shipping[0]['delivery_name'];}?>
                            </td>
                          </tr>
                          <tr>
                            <th>Dirección</th>
                            <td>
                                <?php if (!empty($shipping[0]['address'])) {echo $shipping[0]['address'];}?>
                              </td>
		  		    	    		</tr>
                        <tr>
                            <th>Origen</th>
                            <td>
                                <?php if (!empty($shipping[0]['origin'])) {
    echo $shipping[0]['origin'];
}
?>
                              </td>
		  		    	    		</tr>
                        <tr>
                            <th>Destino</th>
                            <td>
                                <?php if (!empty($shipping[0]['destination'])) {
    echo $shipping[0]['destination'];
}
?>
                              </td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Teléfono</th>
		  		    	    			<td><?php if (!empty($shipping[0]['receiver_phone'])) {
    echo $shipping[0]['receiver_phone'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Email</th>
		  		    	    			<td><?php if (!empty($shipping[0]['receiver_mail'])) {
    echo $shipping[0]['receiver_mail'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
                        <tr>
		  		    	    			<th>Observacion</th>
		  		    	    			<td><?php if (!empty($shipping[0]['observation'])) {
    echo $shipping[0]['observation'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Fecha Envio</th>
		  		    	    			<td><?php if (!empty($shipping[0]['shipping_date'])) {
    echo $shipping[0]['shipping_date'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Estado</th>
		  		    	    			<td><?php if (!empty($shipping[0]['state'])) {
    echo $shipping[0]['state'];
}
?></td>
		  		    	    		</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if (!empty($shipping[0]['created'])) {
    echo $shipping[0]['created'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if (!empty($shipping[0]['modified'])) {
    echo $shipping[0]['modified'];
}
?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CShipping/index" class="btn btn-primary pull-right" role="button">
	                    <i class='fa fa-undo'></i> Volver
	                </a>
				  	</div>
				</div>
			</div>
		</div>
	</section>

</div>

<?php $this->view('footer');?>

<script>
    $(document).ready(function() {
      	$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-shipping').addClass('menu-open');
      	$('#ul-shipping').css('display', 'block');
    });

</script>
</body>
</html>