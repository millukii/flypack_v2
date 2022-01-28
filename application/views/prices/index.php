<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-usd" aria-hidden="true"></i>
              <h3 class="box-title">Precios</h3>
          </div>

          
          <div class="box-body">
                <section class="content">

                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <form id="form-upload_file" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/CPrices/import_excelfile">
                      <input id="input-upload_file" type="file" name="spreadsheet" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                      <input name="input-company" id="input-company" type="hidden" value="0">
                    </form>
                  
                  </div>

                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                  <a href="<?php echo base_url();?>index.php/CPrices/export_excelfile" class="btn btn-primary">Exportar</a
                <br>
                  </div><hr>
                <select class="form-control" id="select-companies" name="select-companies">
                  <option value="">Seleccione una Empresa</option>
                  <?php foreach ($companies as $key) { ?>
                      <option value="<?php echo $key->id; ?>"><?php echo $key->rut.'-'.$key->dv.' '.$key->razon; ?></option>
                    <?php } ?>
                </select>
                <hr>
                    <div id="div-table">
                      <table id="table-prices" class="table table-striped table-bordered table-condensed" style="width:100%;">
                          <thead>
                          <tr>
                            <th width="10%">ID</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Precio</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
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

<script>

    $(document).ready(function() {
      loadDataTable();

      $('#select-companies').change(function(){
        $('#input-company').val($('#select-companies').val());
        loadDataTable();
      });

      $('#input-upload_file').change(function(){
        if($('#select-companies').val() != '' && $('#select-companies').val() != '0')
          $('#form-upload_file').trigger('submit');
        else{
          $('#input-upload_file').val('');
          alert('Debe seleccionar una Empresa');
        }
          
      });
    });

    function loadDataTable()
    {
      $('#div-table').html('<table id="table-prices" class="table table-striped table-bordered table-condensed" style="width:100%;"><thead><tr><th width="10%">ID</th><th>Origen</th><th>Destino</th><th>Precio</th><th>Acción</th></tr></thead><tbody></tbody></table>');
      $('#table-prices').DataTable({
          "lengthMenu": [[2000, 2500, 5000, -1], [2000, 2500, 5000, "All"]],
          'responsive': true,
          'paging': true,
          'info': false,
          'filter': false,
          'ordering': true,
          // 'stateSave': true,
          'processing':true,
          'serverSide':true,
          'language': {
            "url": base_url + "assets/Spanish.json"
          },
          "order": [[0, "asc"]],
          'ajax': {
            "url": site_url + "/CPrices/datatable",
            "type":"POST",
            "data":{company: $('#select-companies').val()},
          },
          "columns": [
            { "data": "ID"},
            { "data": "Origen" },
            { "data": "Destino" },
            { "data": "Precio" },
            { "data": "Acción" }
          ],
          "columnDefs": [
            {
              "targets": [0],
              "orderable": true,
              "render": function(data, type, row) {
                return row.id
              }
            },
            {
              "targets": [1],
              "orderable": true,
              "render": function(data, type, row) {
                return row.from
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.to
              }
            },
           {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.value
              }
            },
            {
              "targets": [4],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CPrices/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>`;
              }
            }
           ],
        });
    }


</script>

</body>
</html>
