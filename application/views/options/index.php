<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-cogs"></i>
            <h3 class="box-title">Opciones Sistema</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-options" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Código</th>
                          <th>Opción</th>
                          <th>Descripción</th>
                          <th>Creado</th>
                          <th>Modificado</th>
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
    $(document).ready(function()
    {
      $('#table-options').DataTable({
          "lengthMenu": [[5, 10, 15, 20,], [5, 10, 15, 20]],
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
            "url": site_url + "/COptions/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Código" },
            { "data": "Opción" },
            { "data": "Descripción" },
            { "data": "Creado" },
            { "data": "Modificado" }
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
                return row.code
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.option
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.description
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.created
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.modified
              }
            }
           ],
        });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-options').addClass('menu-open');
      $('#ul-options').css('display', 'block');
    });
</script>

</body>
</html>
