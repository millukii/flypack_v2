<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Histórico Producción</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-production" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Cantidad</th>
                          <th>Contenedor</th>
                          <th>Producto</th>
                          <th>Persona</th>
                          <th>Proceso</th>
                          <th>Huerto</th>
                          <th>Cuartel</th>
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
      $('#table-production').DataTable({
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
          "order": [[0, "desc"]],
          'ajax': {
            "url": site_url + "/CProduction/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Cantidad" },
            { "data": "Contenedor" },
            { "data": "Producto" },
            { "data": "Persona" },
            { "data": "Proceso" },
            { "data": "Huerto" },
            { "data": "Cuartel" },
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
                return row.quantity
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.container+' | '+row.weight+' '+row.acronym
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.product+' | '+row.variety
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                //return row.rut+'-'+row.dv+' | '+row.name+' '+row.lastname
                return row.rut+' | '+row.name+' '+row.lastname
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.process
              }
            },
            {
              "targets": [6],
              "orderable": true,
              "render": function(data, type, row) {
                return row.orchard
              }
            },
            {
              "targets": [7],
              "orderable": true,
              "render": function(data, type, row) {
                return row.quarter
              }
            },
            {
              "targets": [8],
              "orderable": true,
              "render": function(data, type, row) {
                return row.date
              }
            },
            {
              "targets": [9],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CProduction/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteProduction(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>`;
              }
            }
           ],
        });

      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function deleteProduction(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CProduction/deleteProduction",{
            id  :   id
          },
          function(data)
          {
            if (data == 1)
              window.location.reload();
            else
              alert("Error en el proceso...")
          }
        );
      }
    }

</script>

</body>
</html>
