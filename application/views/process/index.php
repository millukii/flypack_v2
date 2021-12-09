<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-cog"></i>
              <h3 class="box-title">Procesos</h3>
          </div>

          <div class="box-body">
            <section class="content">
                <a href="<?php echo site_url() ?>/CProcess/add" class="btn btn-primary">Agregar</a><br><hr>
                <table id="table-process" class="table table-striped table-bordered table-condensed" style="width:100%;">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th>Proceso</th>
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
      $('#table-process').DataTable({
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
            "url": site_url + "/CProcess/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Proceso" },
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
                return row.process
              }
            },
            {
              "targets": [2],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CProcess/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CProcess/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteProcess(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>`;
              }
            }
           ],
        });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-process').addClass('menu-open');
      $('#ul-process').css('display', 'block');
    });

    function deleteProcess(id) {
      if (confirm('¡Seguro de eliminar!')) {
        $.post(
          site_url + "/CProcess/deleteProcess",{
            id  :   id
          },
          function(data)
          {
            if (data == 1)
            {
              window.location.reload();
            }
            else {
              alert("Error en el proceso...")
            }
          }
        );
      }
    }
</script>

</body>
</html>
