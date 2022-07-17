<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-rocket"></i>
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
                          <th>Operacion</th>
                          <th>Tamaño</th>
                          <th>Total</th>
                          <th>Repartidor</th>
                          <th>Fecha de Envio</th>
                          <th>Estado</th>
                          <th>Empresa</th>
                          <th>Direccion</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Receptor</th>
                          <th>Telefono</th>
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

<div id="modalLabel" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Etiqueta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="iframe-etiqueta" style="height: 200px;width: 100%;" src="#" title="Etiqueta"></iframe>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="printPDF();">Imprimir</button>
      </div>
    </div>
  </div>
</div>

<?php $this->view('footer');?>

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
            { "data": "Operacion"},
            { "data": "Tamaño" },
            { "data": "Total" },
            { "data": "Repartidor" },
            { "data": "Fecha de Envio" },
            { "data": "Estado" },
            { "data": "Empresa" },
            { "data": "Direccion" },
            { "data": "Origen" },
            { "data": "Destino" },
            { "data": "Receptor" },
            { "data": "Telefono" },
            { "data": "Acción" }
          ],
          "columnDefs": [
            {
              "targets": [0],
              "orderable": true,
              "render": function(data, type, row) {
                return row.order_nro
              }
            },
            {
              "targets": [1],
              "orderable": true,
              "render": function(data, type, row) {
                return row.operation
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.shipping_type
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.total_amount
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.delivery_name
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.shipping_date
              }
            },
            {
              "targets": [6],
              "orderable": true,
              "render": function(data, type, row) {
                return row.state
              }
            },
            {
              "targets": [7],
              "orderable": true,
              "render": function(data, type, row) {
                return row.company
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
                return row.destination
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
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a title="Ver Detalle" href="<?php echo site_url(); ?>/CShipping/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'> </i>
                  </a>
                  <a title="Editar" href="<?php echo site_url(); ?>/CShipping/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'> </i>
                  </a>
                  <a href="#" title="Eliminar" class="btn btn-danger btn-xs" role="button" onclick="deleteShipping(`+row.id+`);">
                      <i class='fa fa-trash-o'> </i>
                  </a>
                  <button title="Generar Etiqueta" class="btn btn-success btn-xs" role="button" onclick="generateLabel(`+row.id+`);">
                      <i class='fa fa-qrcode'> </i>
                  </button>`;
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

    function generateLabel(id)
    {
      $.ajax({
        url: site_url + '/CShipping/getQRLabel',
        type: 'post',
        data: {id: id},
        dataType: 'json',
        success: function(response)
        {
          console.log(response);
          $('#iframe-etiqueta').attr('src',response['pathPDF']);
          $('#modalLabel').modal('show');
        }
      });
    }

    function printPDF()
    {
      document.getElementById('iframe-etiqueta').contentWindow.print();
    }
</script>

</body>
</html>
