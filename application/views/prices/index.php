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
                <a href="#" class="btn btn-primary">Importar</a>&nbsp;&nbsp;<a href="#" class="btn btn-primary">Exportar</a
                <br><hr>
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
      $('#table-prices').DataTable({
          "lengthMenu": [[2000, 2500, 5000, -1], [2000, 2500, 5000, "All"]],
          'responsive': true,
          'paging': true,
          'info': true,
          'filter': true,
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

    
    });


</script>

</body>
</html>
