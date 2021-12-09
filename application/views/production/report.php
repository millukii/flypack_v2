<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Reporte Producción</h3>
            </div>

            <div class="box-body">
              <section class="content">

                  <div class="col-sm-12">
                    <div class="col-sm-6">
                      <fieldset>
                        <legend>Tipo</legend>
                        <input onclick="checkRadioType();" type="radio" name="type" value="1" checked>Huerto<br>
                        <input onclick="checkRadioType();" type="radio" name="type" value="2">Cuartel<br>
                        <input onclick="checkRadioType();" type="radio" name="type" value="3">Persona<br>
                        <input onclick="checkRadioType();" type="radio" name="type" value="4">Producto<br>
                        <input onclick="checkRadioType();" type="radio" name="type" value="5">Contratista<br>
                      </fieldset>
                    </div>

                    <div class="col-sm-6">
                      <fieldset>
                        <legend>Fecha</legend>
                        <input onclick="checkRadioDate();" type="radio" name="date" value="2" checked> Intervalo<br>
                        <input onclick="checkRadioDate();" type="radio" name="date" value="0"> Mes<br>
                        <input onclick="checkRadioDate();" type="radio" name="date" value="1"> Fecha
                      </fieldset>
                    </div>
                  <div>

                  <hr>

                  <div class="col-sm-12">

                    <fieldset>
                      <legend>Seleccione:</legend>

                      <div class="col-sm-6">
                        <fieldset>
                          <legend>Tipo:</legend>
                          <div id="div-type">
                            
                            <select class="form-control" id="select-orchards" name="select-orchards">
                              <?php
                                if(!empty($orchards))
                                  foreach($orchards as $o)
                                    echo '<option value="'.$o['id'].'">'.$o['orchard'].'</option>';
                              ?>
                            </select>
                            <br>

                            
                          
                          </div>
                        </fieldset>
                      </div>

                      <div class="col-sm-6">
                        <fieldset>
                          <legend>Fecha:</legend>
                          <div id="div-date"></div>
                        </fieldset>
                      </div>

                    </fieldset>
                    
                    <br>
                    <button onclick="generateReport();" class="btn btn-primary">Generar <i class="fa fa-refresh" aria-hidden="true"></i></button>
                    <hr>

                    <div class="panel with-nav-tabs panel-default">
                      <div class="panel-heading">
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#tab1default" data-toggle="tab">Detalle</a></li>
                                  <li><a href="#tab2default" data-toggle="tab">Resumen</a></li>
                              </ul>
                      </div>
                      <div class="panel-body">
                          <div class="tab-content">
                              <div class="tab-pane fade in active" id="tab1default">
                                
                                <div class="table-responsive" id="div-table_reports">
                                  <table id="table-production" class="table table-striped table-bordered table-condensed" style="width:100%;">
                                    <thead>
                                      <tr>
                                        <th>Persona</th>
                                        <th>Cantidad Acu.</th>
                                        <th>Valor $</th>
                                        <th>Pago Trabajador $</th>
                                        <th>Proceso</th>
                                        <th>Huerto</th>
                                        <th>Cuartel</th>
                                        <th>Producto</th>
                                        <th>Contenedor</th>
                                        <th>Contratista</th>
                                        <th>Pago Acumulado $</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tbody-production"></tbody>
                                  </table>
                                </div>

                              </div>
                              <div class="tab-pane fade" id="tab2default">
                                
                                <div class="table-responsive" id="div-table_reports_resumen">
                                  <table id="table-production_resumen" class="table table-striped table-bordered table-condensed" style="width:100%;">
                                    <thead>
                                      <tr>
                                        <th>Persona</th>
                                        <th>Cantidad Acu.</th>
                                        <th>Pago Trabajador $</th>
                                        <th>Contratista</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tbody-production_resumen"></tbody>
                                  </table>
                                </div>

                              </div>
                          </div>
                      </div>
                  </div>


                    


                  </div>
              </section>
            </div>
            <div class="box-footer"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<!-- <script src="<?php //echo base_url();?>assets/js/buttons.flash.min.js"></script> -->
<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>


<script>
    $(document).ready(function()
    {
      checkRadioDate();
      checkRadioType();

      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function checkRadioDate()
    {
      var radio_date = $('input[name=date]:checked').val();
      var html = '';

      if(radio_date == 1)
      {
        html += '<input type="date" id="input-date" class="form-control">';
      }
      else if(radio_date == 2)
      {
        html += '<div class="col-md-5"><input class="form-control" type="date" id="input-date-init"></div>&nbsp;';
        html += '<div class="col-md-5"><input class="form-control" type="date" id="input-date-end"></div>';
      }
      else
      {
        html += '<div class="col-md-5"><select class="form-control" id="select-year">';
        for(var i=2018; i <= '<?php echo date("Y");?>'; i++ )
        {
          html += '<option value="'+i+'">'+i+'</option>';
        }
        html += '</select></div>';
        html += '&nbsp;&nbsp;';
        html += '<div class="col-md-5"><select class="form-control" id="select-month">';
        html += '<option value="01">Enero</option>';
        html += '<option value="02">Febrero</option>';
        html += '<option value="03">Marzo</option>';
        html += '<option value="04">Abril</option>';
        html += '<option value="05">Mayo</option>';
        html += '<option value="06">Junio</option>';
        html += '<option value="07">Julio</option>';
        html += '<option value="08">Agosto</option>';
        html += '<option value="09">Septiembre</option>';
        html += '<option value="10">Octubre</option>';
        html += '<option value="11">Noviembre</option>';
        html += '<option value="12">Diciembre</option>';
        html += '</select></div>';
      }

      $('#div-date').html(html);
    }

    function checkRadioType()
    {
      var radio_type = $('input[name=type]:checked').val();

      if(radio_type == 1)
      {
        //orchards
        var html = '<select class="form-control" id="select-orchards" name="select-orchards">';
        html += '<?php
          if(!empty($orchards))
            foreach($orchards as $o)
              echo '<option value="'.$o['id'].'">'.$o['orchard'].'</option>';
        ?>';
        html += '</select>';
        $('#div-type').html(html);
      }
      else if(radio_type == 2)
      {
        //quarters
        var html = '<select class="form-control" id="select-quarters" name="select-quarters">';
        html += '<?php
          if(!empty($quarters))
            foreach($quarters as $q)
              echo '<option value="'.$q['id'].'">'.$q['quarter'].' | '.$q['orchard'].'</option>';
        ?>';
        html += '</select>';
        $('#div-type').html(html);
      }
      else if(radio_type == 3)
      {
        //people
        var html = '<select class="form-control" id="select-people" name="select-people">';
        html += '<?php
          if(!empty($people))
            foreach($people as $p)
              echo '<option value="'.$p['id'].'">'.$p['rut'].'-'.$p['dv'].' | '.$p['name'].' '.$p['lastname'].'</option>';
        ?>';
        html += '</select>';
        $('#div-type').html(html);
      }
      else if(radio_type == 4)
      {
        //products
        var html = '<select class="form-control" id="select-products" name="select-products">';
        html += '<?php
          if(!empty($products))
            foreach($products as $p)
              echo '<option value="'.$p['id'].'">'.$p['product'].' | '.$p['variety'].'</option>';
        ?>';
        html += '</select>';
        $('#div-type').html(html);
      }
      else if(radio_type == 5)
      {
        //contractor
        var html = '<select class="form-control" id="select-contractor" name="select-contractor">';
        html += '<?php
          if(!empty($contractor))
            foreach($contractor as $c)
              echo '<option value="'.$c['id'].'">'.$c['name'].' '.$c['lastname'].'</option>';
        ?>';
        html += '</select>';
        $('#div-type').html(html);
      }
    }

    function generateReport()
    {
      var table = '<table id="table-production" class="table table-striped table-bordered table-condensed" style="width:100%;">';
      table += '<thead>';
      table += '<tr>';
      table += '<th>Persona</th>';
      table += '<th>Cantidad Acu.</th>';
      table += '<th>Valor $</th>';
      table += '<th>Pago Trabajador $</th>';
      table += '<th>Proceso</th>';
      table += '<th>Huerto</th>';
      table += '<th>Cuartel</th>';
      table += '<th>Producto</th>';
      table += '<th>Contenedor</th>';
      table += '<th>Contratista</th>';
      table += '<th>Pago Acumulado $</th>';
      table += '</tr>';
      table += '</thead>';
      table += '<tbody id="tbody-production">';
      table += '</tbody>';
      table += '</table>';

      $('#div-table_reports').html(table);

      var radio_date = $('input[name=date]:checked').val();
      var type = $('input[name=type]:checked').val();

      var body = '';

      var array_rut = new Array();
      var array_pago = new Array();

      if(type == 1)
      {
        //orchard
        var orchards = $('#select-orchards').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {
                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      //body += '<td>'+data[i].rut+'-'+data[i].dv+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }
                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {
                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }
                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 2)
      {
        //quarter
        var quarters = $('#select-quarters').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 3)
      {
        //people
        var people = $('#select-people').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 4)
      {
        //product
        var product = $('#select-products').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }

      else if(type == 5)
      {
        //contractor
        var contractor = $('#select-contractor').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                    if(array_rut.includes(data[i].rut))
                    {
                      var index = array_rut.indexOf(data[i].rut);
                      array_pago[index] = (parseInt(array_pago[index]) + parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+array_pago[index]+'</td>';
                      body += '</tr>';
                    }
                    else
                    {
                      array_rut.push(data[i].rut);
                      array_pago.push(parseInt(data[i].payment_));

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>'+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].payment_+'</td>';
                      body += '<td>'+data[i].process+'</td>';
                      body += '<td>'+data[i].orchard+'</td>';
                      body += '<td>'+data[i].quarter+'</td>';
                      body += '<td>'+data[i].product+' | '+data[i].variety+'</td>';
                      body += '<td>'+data[i].container+' | '+data[i].weight+' '+data[i].acronym+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '<td>$ '+data[i].payment_+'</td>';
                      body += '</tr>';
                    }

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }

      generateReport_resumen();
    }

    function generateReport_resumen()
    {
      var table = '<table id="table-production_resumen" class="table table-striped table-bordered table-condensed" style="width:100%;">';
      table += '<thead>';
      table += '<tr>';
      table += '<th>Persona</th>';
      table += '<th>Cantidad Acu.</th>';
      table += '<th>Pago Trabajador $</th>';
      table += '<th>Contratista</th>';
      table += '</tr>';
      table += '</thead>';
      table += '<tbody id="tbody-production_resumen">';
      table += '</tbody>';
      table += '</table>';

      $('#div-table_reports_resumen').html(table);

      var radio_date = $('input[name=date]:checked').val();
      var type = $('input[name=type]:checked').val();

      var body = '';

      var array_rut = new Array();
      var array_pago = new Array();

      if(type == 1)
      {
        //orchard
        var orchards = $('#select-orchards').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {
                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';
                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {
                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';
                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, orchard: orchards},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 2)
      {
        //quarter
        var quarters = $('#select-quarters').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, quarter: quarters},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 3)
      {
        //people
        var people = $('#select-people').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';
                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, people: people},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production').html(body);
                $('#table-production').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }


      else if(type == 4)
      {
        //product
        var product = $('#select-products').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, product: product},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';
                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }

      else if(type == 5)
      {
        //contractor
        var contractor = $('#select-contractor').val();

        if(radio_date == 1)
        {
          //fecha
          fecha = $('#input-date').val();

          if(fecha.length > 0)
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date: fecha, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fecha vacía.');
        }
        else if(radio_date == 2)
        {
          //intervalo
          fecha_ini = $('#input-date-init').val();
          fecha_fin = $('#input-date-end').val();

          if((fecha_ini.length > 0 && fecha_fin.length > 0) && (fecha_ini <= fecha_fin))
          {
            $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, date_init: fecha_ini, date_end: fecha_fin, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';

                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
          }
          else
            alert('Fechas vacías y/o Fecha inicio tiene que ser menor o igual a la Fecha final.');
        } 
        else if(radio_date == 0)
        {
          //mes / año
          var year = $('#select-year').val();
          //mes
          var mes = $('#select-month').val();

          $.ajax({
              url: site_url + '/CProduction/generateReport_resumen',
              type: 'post',
              data: {radio_date: radio_date, year: year, month: mes, type: type, contractor: contractor},
              dataType: 'json',
              success: function(data)
              {
                if(data != null && data.length > 0)
                {
                  for(var i=0;i<data.length;i++)
                  {

                      body += '<tr>';
                      body += '<td>'+data[i].rut+' | '+data[i].name+' '+data[i].lastname+'</td>';
                      body += '<td>'+data[i].quantity+'</td>';
                      body += '<td>$ '+data[i].value_payment+'</td>';
                      body += '<td>'+data[i].contractor+'</td>';
                      body += '</tr>';
                  }
                }

                $('#tbody-production_resumen').html(body);
                $('#table-production_resumen').DataTable(
                    { 
                        'language': { "url": base_url + "assets/Spanish.json" },
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ],
                    }
                );
              }
            });
        }
      }
    }

    function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

</script>

</body>
</html>
