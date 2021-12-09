<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-balance-scale "></i>
              <h3 class="box-title">Unidades de Medida</h3>
          </div>

          <div class="box-body">
            <section class="content">
                <a href="<?php echo site_url() ?>/CUnits/add" class="btn btn-primary">Agregar</a><br><hr>
                <table id="table-units" class="table table-striped table-bordered table-condensed" style="width:100%;">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th>Unidad de Medida</th>
                        <th>Acrónimo</th>
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
      $('#table-units').DataTable({
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
            "url": site_url + "/CUnits/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Unidad de Medida" },
            { "data": "Acrónimo" },
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
                return row.unit
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.acronym
              }
            },
            {
              "targets": [3],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CUnits/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CUnits/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteUnit(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>`;
              }
            }
           ],
        });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-containers').addClass('menu-open');
      $('#ul-containers').css('display', 'block');
    });

    function deleteUnit(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CUnits/deleteUnit",{
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
