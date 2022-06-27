<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-users"></i>
            <?php
            if($operation == 1)
            {
            ?>
                <h3 class="box-title">Generar retiro #<?php echo $order_nro;?></h3>
            <?php
            }
            else if($operation == 2)
            {?>
                <h3 class="box-title"><?php echo $message;?></h3>
            <?php
            }
            ?>
            </div>
            <?php
            if($operation != 2 && $success != 1)
            {
            ?>
                <div class="box-body">
                    <section class="content">
                        <span></span>
                        <div class="pull-right">
                            <span>&nbsp;&nbsp;</span>
                        </div>
                        <form action="<?php echo base_url()?>index.php/CShipping/validarRetiro" method="post">
                            <br>
                            <input required class="form-control" id="input-user" name="input-user" placeholder="Usuario">
                            <br>
                            <input type="password" required class="form-control" id="input-password" name="input-password" placeholder="Contraseña">
                            <br>
                            <input type="hidden" name="input-order_nro" id="input-order_nro" value="<?php echo $order_nro;?>">
                            <button class="btn btn-success">Confirmar</button>
                        </form>
                    </section>
                </div>
            <?php  
            }
            ?>
            <div class="box-footer"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script>
    $(document).ready(function()
    {

    });
</script>

</body>
</html>
