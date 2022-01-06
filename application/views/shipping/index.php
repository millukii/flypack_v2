<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-users"></i>
            <h3 class="box-title">Ordenes de Transporte</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CShipping/add" class="btn btn-primary">Agregar</a>
                  <br>
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-shipping" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>Orden</th>
                          <th>Tipo</th>
                          <th>Total</th>
                          <th>Delivery</th>
                          <th>Fecha de Envio</th>
                          <th>Estado</th>
                          <th>Empresa</th>
                          <th>Emisor</th>
                          <th>Direccion</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Receptor</th>
                          <th>Telefono</th>
                          <th>Etiqueta</th>
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
      $('#table-shipping').DataTable({
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
            "url": site_url + "/CShipping/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "Orden"},
            { "data": "Tipo" },
            { "data": "Total" },
            { "data": "Delivery" },
            { "data": "Fecha de Envio" },
            { "data": "Estado" },
            { "data": "Empresa" },
            { "data": "Emisor" },
            { "data": "Direccion" },
            { "data": "Origen" },
            { "data": "Destino" },
            { "data": "Receptor" },
            { "data": "Telefono" },
            { "data": "Etiqueta" },
            { "data": "Acción" }
          ],
          "columnDefs": [
            {
              "targets": [0],
              "orderable": true,
              "render": function(data, type, row) {
                return row.order_nro
              }
            },/* 
            {
              "targets": [1],
              "orderable": true,
              "render": function(data, type, row) {
                return row.quadmins_code
              }
            }, */
            {
              "targets": [1],
              "orderable": true,
              "render": function(data, type, row) {
                return row.shipping_type
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.total_amount
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.delivery_name
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.shipping_date
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.state
              }
            },
            {
              "targets": [6],
              "orderable": true,
              "render": function(data, type, row) {
                return row.company
              }
            },
            {
              "targets": [7],
              "orderable": true,
              "render": function(data, type, row) {
                return row.sender
              }
            },
            {
              "targets": [8],
              "orderable": true,
              "render": function(data, type, row) {
                return row.address
              }
            },
           {
              "targets": [9],
              "orderable": true,
              "render": function(data, type, row) {
                return row.origin
              }
            },
            {
              "targets": [10],
              "orderable": true,
              "render": function(data, type, row) {
                return row.destiny
              }
            },
            {
              "targets": [11],
              "orderable": true,
              "render": function(data, type, row) {
                return row.receiver_name
              }
            },
            {
              "targets": [12],
              "orderable": true,
              "render": function(data, type, row) {
                return row.receiver_phone
              }
            },
            {
              "targets": [13],
              "orderable": true,
              "render": function(data, type, row) {
                return row.label
              }
            },
            {
              "targets": [14],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CShipping/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'> </i>
                  </a>
                  <a href="<?php echo site_url(); ?>/CShipping/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'> </i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteShipping(`+row.id+`);">
                      <i class='fa fa-trash-o'> </i>
                  </a>`;
              }
            }
           ],
        });

      /*$('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-shipping').addClass('menu-open');
      $('#ul-shipping').css('display', 'block');
      */
    });

    function deleteShipping(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CShipping/deleteShipping",{
          id  :   id
        },
        function(data)
        {
          if (data == 1)
            window.location.reload();
          else
            alert("Este registro posee dependencias asociadas.\nNo se puede eliminar.")
        });
      }
    }
</script>

</body>
</html>
