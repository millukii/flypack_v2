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
                <h3 class="box-title">Generar retiro de ordenes</h3>
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
                        <!--
                        <form action="<?php //echo base_url()?>index.php/CShipping/validarRetiro" method="post">
                            <br>
                            <input required class="form-control" id="input-user" name="input-user" placeholder="Usuario">
                            <br>
                            <input type="password" required class="form-control" id="input-password" name="input-password" placeholder="Contraseña">
                            <br>
                            <input type="hidden" name="input-order_nro" id="input-order_nro" value="<?php //echo $order_nro;?>">
                            <button class="btn btn-success">Confirmar</button>
                        </form>
                        -->
                        <div id="qr-reader" style="width: 100%"></div>
                        <br>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                        <p id="p-total">Total: </p>
                        <button class="btn btn-success" onclick="enviarRetiros();">Enviar</button>
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

<!-- include the library -->
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

<?php $this->view('footer'); ?>

<script>
    $(document).ready(function()
    {
        
    });

    function removerOrden(order)
    {
        $('#tr-'+order).remove();
        $('#p-total').html('Total: '+$('#tbody>tr').length);
    }

    function listar(order)
    {
        if($("#tr-"+order).length == false)
        {
            let tbody = '';
            tbody += '<tr id="tr-'+order+'">';
            tbody += '<td>'+order+'</td>';
            tbody += '<td><button id="'+order+'" class="btn btn-danger btn-xs" onclick="removerOrden(this.id);">remover</button></td>';
            tbody += '</tr>';

            $('#tbody').append(tbody);
        }

        $('#p-total').html('Total: '+$('#tbody>tr').length);
    }

    function enviarRetiros()
    {
        let c = confirm('Confirme el Retiro de todas las ordenes listadas.');
        if(c)
        {
            alert('confirmado');
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
        //console.log(`Code scanned = ${decodedText}`, decodedResult);
        let c = confirm('Confirme la lectura: '+decodedText);
        if(c)
        {
            $.ajax({
                url: site_url + '/CShipping/readQR',
                type: 'post',
                data: {qr: decodedText},
                dataType: 'text',
                success: function(data)
                {
                    if(data.length > 0)
                    {
                        listar(data);
                    }
                        
                }
            });
        }
    }
    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
