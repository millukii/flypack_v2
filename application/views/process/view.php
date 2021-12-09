<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header ui-sortable-handle">
					    <i class="fa fa-cog"></i>
						<h3 class="box-title">Proceso</h3>
				  	</div>

				  	<div class="box-body">
			  			<section class="content">
			  			    <table class="table">
		  		    		    <tbody>
		  		    		    	<tr>
		  		    		    		<th>Id</th>
		  			    				<td><?php if(!empty($process[0]['id'])) echo $process[0]['id'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    		    		<th>Perfil</th>
		  			    				<td><?php if(!empty($process[0]['process'])) echo $process[0]['process'];?></td>
		  		    		    	</tr>
		  		    		    	<tr>
		  		    	    			<th>Creado</th>
		  		    	    			<td><?php if(!empty($process[0]['created'])) echo $process[0]['created'];?></td>
		  		    	    		</tr>
		  		    	    		<tr>
		  		    	    			<th>Modificado</th>
		  		    	    			<td><?php if(!empty($process[0]['modified'])) echo $process[0]['modified'];?></td>
		  		    	    		</tr>
		  		    		    </tbody>
		  			    	</table>
			  			</section>
				  	</div>
				  	<div class="box-footer">
				  		<a href="<?php echo site_url(); ?>/CProcess/index" class="btn btn-primary pull-right" role="button">
	                    <i class='fa fa-undo'></i> Volver
	                </a>
				  	</div>
				</div>
			</div>
		</div>
	</section>
	
</div>

<?php $this->view('footer'); ?>

<script>
    $(document).ready(function() {
      	$('#li-configuration').addClass('menu-open');
      	$('#ul-configuration').css('display', 'block');

      	$('#li-process').addClass('menu-open');
      	$('#ul-process').css('display', 'block');
    });
  
</script>
</body>
</html>