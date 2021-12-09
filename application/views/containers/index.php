<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-suitcase"></i>
            <h3 class="box-title">Contenedores</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CContainers/add" class="btn btn-primary">Agregar</a>
                  <br>
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-containers" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Contenedor</th>
                          <th>Peso</th>
                          <th>Unidad</th>
                          <th>Valor Pago</th>
                          <th>Valor Venta</th>
                          <th>Producto</th>
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
      $('#table-containers').DataTable({
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
            "url": site_url + "/CContainers/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Contenedor" },
            { "data": "Peso" },
            { "data": "Unidad" },
            { "data": "Valor Pago" },
            { "data": "Valor Venta" },
            { "data": "Producto" },
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
                return row.container
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.weight
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.acronym + ' | ' + row.unit 
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return '$ ' + separatorMiles(row.value_payment)
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return '$ ' + separatorMiles(row.value_sale)
              }
            },
            {
              "targets": [6],
              "orderable": true,
              "render": function(data, type, row) {
                return row.product + ' | ' + row.variety
              }
            },
            {
              "targets": [7],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CContainers/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CContainers/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteContainer(`+row.id+`);">
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

    function deleteContainer(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CContainers/deleteContainer",{
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

    function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>

</body>
</html>
