<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-file-text"></i>
            <h3 class="box-title">Logs</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-logs" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Asunto</th>
                          <th>Acción Log</th>
                          <th>Usuario</th>
                          <th>Fecha</th>
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
    $(document).ready(function()
    {
      $('#table-logs').DataTable({
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
            "url": site_url + "/CLogs/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Asunto" },
            { "data": "Acción Log" },
            { "data": "Usuario" },
            { "data": "Fecha" },
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
                return row.subject
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.action
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.user
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
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CLogs/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>`;
              }
            }
           ],
        });

      $('#li-utils').addClass('menu-open');
      $('#ul-utils').css('display', 'block');
    });

</script>

</body>
</html>
