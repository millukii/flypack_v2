<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					<i class="fa fa-university"></i>
						<h3 class="box-title">Company</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if (!empty($company[0]['id'])) {
    echo $company[0]['id'];
}
?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Rut</th>
		  			    				<td><?php if (!empty($company[0]['rut'])) {
    echo $company[0]['rut'];
}
?>-<?php if (!empty($company[0]['dv'])) {
    echo $company[0]['dv'];
}
?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Razon</th>
		  		    	    			<td><?php if (!empty($company[0]['razon'])) {
    echo $company[0]['razon'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Nombre de Fantasia</th>
		  		    	    			<td><?php if (!empty($company[0]['fantasy'])) {
    echo $company[0]['fantasy'];
}
?></td>
		  		    	    		</tr>
                        <tr>
		  		    	    			<th>Prefijo</th>
		  		    	    			<td><?php if (!empty($company[0]['prefix'])) {
    echo $company[0]['prefix'];
}
?></td>
		  		    	    		</tr>
									<tr>
                          				<th>Email</th>
                          				<td><?php if (!empty($company[0]['email'])) {
    echo $company[0]['email'];
}
?></td>
                          			</tr>
		  		    	    		<tr>
		  		    	    			<th>Dirección</th>
		  		    	    			<td><?php if (!empty($company[0]['address'])) {
    echo $company[0]['address'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Ciudad</th>
		  		    	    			<td><?php if (!empty($company[0]['city'])) {
    echo $company[0]['city'];
}
?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Comuna</th>
		  		    	    			<td><?php if (!empty($company[0]['commune'])) {
    echo $company[0]['commune'];
}
?></td>
		  		    	    		</tr>
									  <tr>
		  		    	    			<th>Tipo Tarifa Precios</th>
		  		    	    			<td><?php if ($company[0]['type_rate'] == 1) {
    echo 'Estandar (Origen a Destino)';
} else {echo 'Tamaño Paquete';}?></td>
		  		    	    		</tr>
									<tr>
		  		    	    			<th>Estado</th>
		  		    	    			<td><?php if (!empty($company[0]['state'])) {
    echo $company[0]['state'];
}
?></td>
		  		    	    		</tr>

		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>

					<div class="box-body">
					  <h4>Sucursales:</h4>
			  			<section class="content">

			  			    <table class="table">
								<thead>
									<tr>
										<th>Ciudad</th>
										<th>Comuna</th>
										<th>Dirección</th>
									</tr>
								</thead>
		  		    		    <tbody>
								  	<?php
if (!empty($sucursales)) {
    foreach ($sucursales as $key) {?>
										<tr>
											<?php echo '<td>' . $key->city . '</td>';
        echo '<td>' . $key->commune . '</td>';
        echo '<td>' . $key->address . '</td>'; ?>
									  	</tr>
									<?php }}?>
		  		    		    </tbody>
		  			    	</table>

			  			</section>

				  	</div>

					<div class="box-body">
					  <h4>Usuarios:</h4>
			  			<section class="content">

			  			    <table class="table">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Nombre</th>
									</tr>
								</thead>
		  		    		    <tbody>
								  	<?php
if (!empty($users)) {
    foreach ($users as $key) {?>
										<tr>
											<?php echo '<td>' . $key->user . '</td>';
        echo '<td>' . $key->name . '</td>'; ?>
									  	</tr>
									<?php }}?>
		  		    		    </tbody>
		  			    	</table>

			  			</section>

				  	</div>

				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CCompany/index" class="btn btn-primary pull-right" role="button">
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

      	$('#li-company').addClass('menu-open');
      	$('#ul-company').css('display', 'block');
    });

</script>
</body>
</html>