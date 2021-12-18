<style>
    #div-message2
    {
        font-size: 18px;
    }
    
    #div-message
    {
        font-size: 18px;
    }
</style>
<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-hand-stop-o" aria-hidden="true"></i>
            <h3 class="box-title">Control</h3>
            </div>

            <div class="box-body">
              <section class="content">

                <fieldset>
                  <legend>Datos Generales:</legend>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Proceso</label>
                    <div class="col-sm-10">
                      <select name="select-process" id="select-process" class="form-control">
                        <?php
                        if(!empty($process))
                        {
                          foreach($process as $p)
                            echo '<option value="'.$p['id'].'">'.$p['process'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <br>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Huerto</label>
                    <div class="col-sm-10">
                      <select name="select-orchards" id="select-orchards" class="form-control" onchange="loadQuarters(this.value);">
                        <option value="">Seleccione una opción</option>
                        <?php
                        if(!empty($orchards))
                        {
                          foreach($orchards as $o)
                            echo '<option value="'.$o['id'].'">'.$o['orchard'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <br>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Cuartel</label>
                    <div class="col-sm-10">
                      <select disabled name="select-quarters" id="select-quarters" class="form-control" onchange="loadProducts(this.value);">
                        <option value="">Seleccione una opción</option>
                      </select>
                    </div>
                  </div>

                  <br>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Producto</label>
                    <div class="col-sm-10">
                     <select disabled name="select-products" id="select-products" class="form-control" onchange="loadContainers(this.value);">
                        <option value="">Seleccione una opción</option>
                        <?php
                        if(!empty($product))
                        {
                          foreach($product as $p)
                            echo '<option value="'.$p['id'].'">'.$p['product'].' | '.$p['variety'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <br>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Contenedor</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="input-container" id="input-container" value="--" disabled>
                    </div>
                  </div>

                  <br>

                </fieldset>
                <div id="div-message2"></div>
                <br>
                <button id="btn-blocked" class="btn btn-primary btn-lg btn-block" onclick="Blocked_();">Bloquear Datos Generales</button>
                <hr>
                <fieldset>
                  <legend>Datos Persona:</legend>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Rut</label>
                    <div class="col-sm-10">
                      <input disabled type="text" class="form-control" name="input-rut" id="input-rut" required>
                    </div>
                  </div>
                  
                  <br>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="input-name_lastname" id="input-name_lastname" value="--" disabled>
                    </div>
                  </div>

                  <br>

                </fieldset>

                <hr>
                <div id="div-message"></div>
               <!-- 
                <hr>
                <button disabled id="btn-save" type="button" class="btn btn-success" onclick="saveProduction();">Guardar</button>
                -->
              </section>
            </div>
            <div class="box-footer">
              
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script>
    //VARIABLES SELECTORES
    var people_id = 0;
    var quarters_id = 0;
    var products_id = 0;
    var containers_id = 0;
    var value_payment = 0;
    var value_sale = 0;
    //--------------------------------
    //VARIABLES BLOQUEOS
    var blocked = false;
    //--------------------------------

    $(document).ready(function()
    {
      $('#input-rut').keyup(function(e){
        if(e.keyCode == 13)
          loadPeople(this.value);
      });

    });

    function loadQuarters(value)
    {
      quarters_id = 0;
      products_id = 0;
      containers_id = 0;
      value_payment = 0;
      value_sale = 0;

      var options = '<option value="">Seleccione una opción</option>';
      var input_value = '--';

      //$('#select-products').html('<option value="">Seleccione una opción</option>');
      //$('#input-container').val('--');

      $.ajax({
        url: site_url + '/CControl/getQuarters_Orchard',
        dataType: 'json',
        data: {orchards_id: value},
        type: 'post',
        success: function(data)
        {
          if(data.length > 0 && data != null)
          {
            for(var i=0; i<data.length;i++)
            {
              options += '<option value="'+data[i]['id']+'">'+data[i]['quarter']+'</option>';
            }

            $('#select-quarters').attr('disabled', false);
          }
          else
          {
            $('#select-quarters').attr('disabled', true);
            $('#select-products').attr('disabled', true);

            $('#select-products').html(options);
            $('#input-container').val(input_value);

          }
          $('#select-quarters').html(options);
        }
      });
    }

    function loadProducts(value)
    {
      quarters_id = 0;
      products_id = 0;
      containers_id = 0;
      value_payment = 0;
      value_sale = 0;

      var options = '<option value="">Seleccione una opción</option>';
      var input_value = '--';

      $.ajax({
        url: site_url + '/CControl/getProducts_Quarter',
        dataType: 'json',
        data: {quarter_id: value},
        type: 'post',
        success: function(data)
        { 
          $('#select-products').attr('disabled', false);

          if(data['product'] != null && data['container'] != null && data['product'].length > 0 && data['container'].length > 0)
          {
            for(var i=0; i< data['product'].length; i++)
            {
              options += '<option value="'+data['product'][i]['id']+'">'+data['product'][i]['product']+' | '+data['product'][i]['variety']+'</option>';
            }
            
            $('#select-products').html(options);
            $('#input-container').val(input_value);
          }
          else
          {
            $('#select-products').attr('disabled', true);
            $('#select-products').html(options);
            products_id = 0;
            containers_id = 0;
            $('#input-container').val('Producto sin contenedor encontrado.');
            value_payment = 0;
            value_sale = 0;
          }
          
        }
      });
    }

    function loadContainers(value)
    {
       $.ajax({
        url: site_url + '/CControl/getContainer_Product',
        dataType: 'json',
        data: {products_id: value},
        type: 'post',
        success: function(data)
        { 
          if(data['container'][0] != null)
          {
            containers_id = data['container'][0]['id'];
            $('#input-container').val(data['container'][0]['container']+' | '+data['container'][0]['weight']+' '+data['container'][0]['acronym']);

            value_payment = data['container'][0]['value_payment'];
            value_sale = data['container'][0]['value_sale'];
          }
          else
          {
            containers_id = 0;
            $('#input-container').val('Producto sin contenedor encontrado.');

            value_payment = 0;
            value_sale = 0;
          }
        }
      });

    }

    function loadPeople(value)
    {
      people_id = 0;
      $('#input-name_lastname').val('Buscando...');
      $('#input-rut').attr('readonly', true);

      $.ajax({
        url: site_url + '/CControl/getPeople_Rut',
        dataType: 'json',
        data: {rut: value},
        type: 'post',
        success: function(data)
        {
          if(data.length > 0 && data != null)
          {
            people_id = data[0]['id'];
            $('#input-name_lastname').css('color','blue');
            $('#input-name_lastname').val(data[0]['name']+' '+data[0]['lastname']);
            saveProduction();
          }
          else
          {
            people_id = 0;
            $('#input-name_lastname').css('color', 'red');
            $('#input-name_lastname').val('Persona no encontrada.');

            $('#input-rut').val('');
            $('#input-rut').focus();
          }

          $('#input-rut').attr('readonly', false);
        }
      });
    }


    function saveProduction()
    {
      var process_id = $('#select-process').val();
      var quarters_id = $('#select-quarters').val();
      products_id = $('#select-products').val();

      //alert('containers = '+containers_id+' | products = '+products_id+' | people = '+people_id+' | proceso = '+ process_id +' | quarter : '+ quarters_id + ' value_payment = '+value_payment + ' | value_sale = '+value_sale);

      if(containers_id != 0 && products_id != 0 && people_id != 0 && process_id != 0 && value_payment != 0 && value_sale != 0)
      {
        $.ajax({
          url: site_url + '/CControl/addProduction',
          dataType: 'text',
          type: 'post',
          data: {quantity: 1, containers_id: containers_id, products_id: products_id, people_id: people_id, process_id: process_id, quarters_id: quarters_id, value_payment: value_payment, value_sale: value_sale},
          success: function(data)
          {
            if(data != 0)
            {
              $('#div-message').html(data);

              people_id = 0;
              $('#input-rut').val('');
              $('#input-name_lastname').css('color', 'black');
              $('#input-name_lastname').val('--');
              $('#input-rut').focus();
              
            }
            else
            {
              $('#div-message').html('<p><font color="red"><b>No se pudo generar el registro.<br>Consulte al Administrador del sistema. Persona Eliminada o Suspendida.</b></font></p>');
            }
          }
        });
      }
      else
        $('#div-message').html('<p><font color="red"><b>Faltan datos para generar registro.<br>Verifique que todos los datos han sido seleccionado y/o ingresados.</b></font></p>');

      
    }

    function Blocked_()
    {
      var process_ = $('#select-process').val();
      var orchards_ = $('#select-orchards').val();
      var quarters_ = $('#select-quarters').val();
      var products_ = $('#select-products').val();

      if(blocked)
      {
        $('#select-process').attr('disabled', false);
        $('#select-orchards').attr('disabled', false);
        $('#select-quarters').attr('disabled', false);
        $('#select-products').attr('disabled', false);

        $('#input-rut').attr('disabled', true);

        $('#btn-blocked').html('Bloquear Datos Generales');
        $('#btn-blocked').attr('class', 'btn btn-primary btn-lg btn-block');
        $('#btn-save').attr('disabled', true);
        blocked = false;

        $('#div-message').html('');

         $('html, body').animate({
          scrollTop: $("#select-process").offset().top
        }, 1);    

        
      }
      else
      {
        if(process_ != 0 && orchards_ != 0 && quarters_ != 0 && products_ != 0)
        {
            $('#select-process').attr('disabled', true);
            $('#select-orchards').attr('disabled', true);
            $('#select-quarters').attr('disabled', true);
            $('#select-products').attr('disabled', true);

            $('#input-rut').attr('disabled', false);

            $('#input-rut').focus();

            $('#btn-blocked').html('Desbloquear Datos Generales');
            $('#btn-blocked').attr('class', 'btn btn-secondary btn-lg btn-block');
            $('#btn-save').attr('disabled', false);
            blocked = true;

            $('#div-message2').html('');
        }
        else
          $('#div-message2').html('<p><font color="red"><b>Verifique la selección de un proceso, huerto, cuartel y producto</b></font></p>');
      }
      
    }

    function deleteProduction(production_id)
    {
      var c = confirm('Confirme eliminación');
      if(c)
      {
        $.ajax({
          url: site_url + '/CProduction/deleteProduction',
          type: 'post',
          dataType: 'text',
          data: {id: production_id},
          success: function(data)
          {
            if(data == 1)
              $('#div-message').html('<p><font color="green"><b>Registro eliminado</b></font></p>');
            else
              $('#div-message').html('<p><font color="red"><b>No se pudo eliminar el registro.<br>Consulte al Administrador del sistema.</b></font></p>');

            $('#input-rut').focus();
          }
        });
      }
      
    }
</script>

</body>
</html>
