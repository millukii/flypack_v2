<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Reporte Asistencia</h3>
            </div>

            <div class="box-body">
              <section class="content">
                    
                <div class="col-sm-4">
                  <select class="form-control" id="select-year">
                    <?php
                    for($i = 2018; $i <= date('Y'); $i++)
                    {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                  </select>
                </div>
                &nbsp;&nbsp;
                <div class="col-sm-4">
                  <select class="form-control" id="select-month">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <button onclick="generateReportAsist();" class="btn btn-primary">Generar <i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>

                    <hr>
                    <div class="table-responsive" id="div-table_asist">
                      <table id="table-asist" class="table table-striped table-bordered table-condensed" style="width:100%;">
                        <thead>
                          <tr>
                            <th>N</th>
                            <th>Persona</th>
                            <th>Perfil</th>
                            <th>Cantidad Días</th>
                            <th>Días</th>
                          </tr>
                        </thead>
                        <tbody id="tbody-asist"></tbody>
                      </table>
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
      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function generateReportAsist()
    {
      var month = $('#select-month').val();
      var year = $('#select-year').val();

      var table = '<table id="table-asist" class="table table-striped table-bordered table-condensed" style="width:100%;">';
      table += '<thead>';
      table += '<tr>';
      table += '<th>N</th>';
      table += '<th>Persona</th>';
      table += '<th>Perfil</th>';
      table += '<th>Cantidad Días</th>';
      table += '<th>Días</th>';
      table += '</tr>';
      table += '</thead>';
      table += '<tbody id="tbody-asist">';
      table += '</tbody>';
      table += '</table>';

      $('#div-table_asist').html(table);

      var body = '';
      var array_rut = new Array();
      var array_nombre = new Array();
      var array_perfil = new Array();
      var array_cant = new Array();
      var array_dias = new Array();

      $.ajax({
        url: site_url + '/CProduction/reportAsist',
        type: 'post',
        dataType: 'json',
        data: {month : month, year: year},
        success: function(data)
        {
          if(data != null && data.length > 0)
          {
            for(var i=0;i<data.length;i++)
            {

              if(array_rut.includes(data[i].rut))
              {
                var index = array_rut.indexOf(data[i].rut);
                array_cant[index] = (parseInt(array_cant[index]) + 1);
                array_dias[index] = array_dias[index] +' | ' +data[i].day;
              }
              else
              {
                array_rut.push(data[i].rut);
                array_nombre.push(data[i].rut+' | '+data[i].name+' '+data[i].lastname);
                array_perfil.push(data[i].profile);
                array_cant.push(1);
                array_dias.push(data[i].day);
              }  
            }

            for(var i=0; i<array_rut.length;i++)
            {
              body += '<tr>';
              body += '<td>'+(i+1)+'</td>';
              body += '<td>'+array_nombre[i]+'</td>';
              body += '<td>'+array_perfil[i]+'</td>';
              body += '<td>'+array_cant[i]+'</td>';
              body += '<td>'+array_dias[i]+'</td>';
              body += '</tr>';   
            }
          }

          $('#tbody-asist').html(body);
          $('#table-asist').DataTable(
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
</script>

</body>
</html>
