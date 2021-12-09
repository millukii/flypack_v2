<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-users"></i>
            <h3 class="box-title">Sesiones</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-session" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Usuario</th>
                          <th>Persona</th>
                          <th>Fecha</th>
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
      $('#table-session').DataTable({
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
            "url": site_url + "/CSession/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Usuario" },
            { "data": "Persona" },
            { "data": "Fecha" }
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
                return row.user
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.rut+'-'+row.dv+' | '+row.name+' '+row.lastname 
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                 return row.created
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
