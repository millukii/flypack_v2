<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Resumen Diario</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CProduction/add_response" class="btn btn-primary">Agregar</a>
                  <br><br>
                  <table id="table-response" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Producto-Variedad</th>
                          <th>Peso (KG)</th>
                          <th>Cantidad (Cajas)</th>
                          <th>Peso / Cantidad (KPC)</th>
                          <th>Acciones</th>
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
      $('#table-response').DataTable({
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
            "url": site_url + "/CProduction/datatable_response",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Fecha" },
            { "data": "Producto-Variedad" },
            { "data": "Peso (KG)" },
            { "data": "Cantidad (Cajas)" },
            { "data": "Peso / Cantidad (KPC)" },
            { "data": "Acciones"}
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
                return row.date
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.product+' | '+row.variety
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.weight
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.quantity
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.w_q
              }
            },
            {
              "targets": [6],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CProduction/edit_response?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteResponse(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>`;
              }
            }
           ],
        });

      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function deleteResponse(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CProduction/deleteResponse",{
          id  :   id
        },
        function(data)
        {
          if (data == 1)
            window.location.reload();
          else
            alert("No se puede eliminar.")
        });
      }
    }

</script>

</body>
</html>
