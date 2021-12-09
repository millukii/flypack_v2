<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-hand-stop-o" aria-hidden="true"></i>
            <h3 class="box-title">Ingreso Desfasado</h3>
            </div>

            <div class="box-body">
              <section class="content">

                <fieldset>
                  <legend>Datos Generales:</legend>
                   <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Persona</label>
                    <div class="col-sm-10">
                      <select name="select-people" id="select-people" class="form-control">
                        <?php
                        if(!empty($people))
                        {
                          foreach($people as $p)
                            echo '<option value="'.$p['id'].'">'.$p['rut'].' | '.$p['name'].' '.$p['lastname'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Cantidad</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="input-quantity" id="input-quantity" value="0">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="rut" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                     <input type="date" class="form-control" name="input-date" id="input-date">
                    </div>
                  </div>

                </fieldset>

                <hr>

                <fieldset>
                  <legend>Datos Producción:</legend>

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
                <br>
                <button class="btn btn-success" onclick="saveDesfase();">Agregar</button>
                <button class="btn btn-danger" onclick="removeDesfase();">Remover</button>
              </section>
            </div>
            <div class="box-footer">
              
            </div>

            <hr>
                <div id="div-message"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script>
    //VARIABLES SELECTORES
    var containers_id = 0;
    var value_payment = 0;
    var value_sale = 0;

    $(document).ready(function()
    {
      var now = new Date();
      var temp = now.getMonth() + 1;
      if(temp <= 9)
        temp = "0" + temp;

      var today =  now.getFullYear() + '-' + temp + '-' + now.getDate();
      $('#input-date').val(today);

      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');

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


    function saveDesfase()
    {

      var people_id = $('#select-people').val();
      var quantity = $('#input-quantity').val();
      var date = $('#input-date').val();


      var process_id = $('#select-process').val();
      var quarters_id = $('#select-quarters').val();
      var products_id = $('#select-products').val();

      //alert(people_id+' | '+quantity+' | '+date+' | '+process_id+' | '+quarters_id+' | '+products_id+' | '+containers_id+' | '+value_payment+' | '+value_sale);

      
      if(containers_id != 0 && products_id != 0 && people_id != 0 && process_id != 0 && value_payment != 0 && value_sale != 0)
      {
        
        var c = confirm('Confirme la generación del desfase');
        if(c)
        {
          $.ajax({
            url: site_url + '/CControl/add_out_of_date',
            dataType: 'text',
            type: 'post',
            data: {n: quantity, containers_id: containers_id, products_id: products_id, people_id: people_id, process_id: process_id, quarters_id: quarters_id, value_payment: value_payment, value_sale: value_sale, date: date},
            success: function(data)
            {
              if(data == 1)
              {
                alert('Registro Generado correctamente.');
                location.reload();
              }
              else
              {
                $('#div-message').html('<p><font color="red"><b>No se pudo generar el registro.<br>Consulte al Administrador del sistema.</b></font></p>');
              }
            }
          });
        }
        

      }
      else
        $('#div-message').html('<p><font color="red"><b>Faltan datos para generar registro.<br>Verifique que todos los datos han sido seleccionado y/o ingresados.</b></font></p>');
      
      
    }
    
    function removeDesfase()
    {

      var people_id = $('#select-people').val();
      var quantity = $('#input-quantity').val();
      var date = $('#input-date').val();


      var process_id = $('#select-process').val();
      var quarters_id = $('#select-quarters').val();
      var products_id = $('#select-products').val();

      //alert(people_id+' | '+quantity+' | '+date+' | '+process_id+' | '+quarters_id+' | '+products_id+' | '+containers_id+' | '+value_payment+' | '+value_sale);

      
      if(containers_id != 0 && products_id != 0 && people_id != 0 && process_id != 0 && value_payment != 0 && value_sale != 0)
      {
        
        var c = confirm('Confirme la disminución desfasada.');
        if(c)
        {
          $.ajax({
            url: site_url + '/CControl/remove_out_of_date',
            dataType: 'text',
            type: 'post',
            data: {n: quantity, containers_id: containers_id, products_id: products_id, people_id: people_id, process_id: process_id, quarters_id: quarters_id, value_payment: value_payment, value_sale: value_sale, date: date},
            success: function(data)
            {
              if(data == 1)
              {
                alert('Registro Generado correctamente.');
                location.reload();
              }
              else
              {
                $('#div-message').html('<p><font color="red"><b>No se pudo generar el registro.<br>Revise que los parámetros coincidan..</b></font></p>');
              }
            }
          });
        }
        

      }
      else
        $('#div-message').html('<p><font color="red"><b>Faltan datos para generar registro.<br>Verifique que todos los datos han sido seleccionado y/o ingresados.</b></font></p>');
      
      
    }


</script>

</body>
</html>
