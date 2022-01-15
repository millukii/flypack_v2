<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
            <i class="fa fa-users"></i>
            <h3 class="box-title">Usuarios</h3>
          </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CUsers/add" class="btn btn-primary">Agregar</a><br><hr>
                  <table id="table-users" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Usuario</th>
                          <th>Rol</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Empresa</th>
                          <th>Estado</th>
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
      $('#table-users').DataTable({
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
            "url": site_url + "/CUsers/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Usuario" },
            { "data": "Rol" },
            { "data": "Nombre" },
            { "data": "Email" },
            { "data": "Empresa" },
            { "data": "Estado" },
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
                return row.user
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.rol
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.name
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.email
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.razon
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
              "orderable": false,
              "render": function(data, type, row) {
                return  `
                  <a href="<?php echo site_url(); ?>/CUsers/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CUsers/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteUser(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>` ;
              }
            }
           ],
        });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-users').addClass('menu-open');
      $('#ul-users').css('display', 'block');
    });

    
    function deleteUser(id) 
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.ajax({
          url: site_url + '/CUsers/deleteUser',
          data: {id: id},
          type: 'post',
          dataType: 'text',
          success: function(data)
          {
            window.location.reload();
          }
        });
      }
    }
    
</script>

</body>
</html>
