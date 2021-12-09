<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-users"></i>
            <h3 class="box-title">Personas</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CPeople/add" class="btn btn-primary">Agregar</a>
                  <br>
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-people" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Rut</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Teléfono</th>
                          <th>Perfil</th>
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
    $(document).ready(function()
    {
      $('#table-people').DataTable({
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
            "url": site_url + "/CPeople/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Rut" },
            { "data": "Nombre" },
            { "data": "Apellidos" },
            { "data": "Teléfono" },
            { "data": "Perfil" },
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
                //return row.rut + '-' + row.dv
                return row.rut
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.name
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.lastname
              }
            },
            {
              "targets": [4],
              "orderable": true,
              "render": function(data, type, row) {
                return row.phone
              }
            },
            {
              "targets": [5],
              "orderable": true,
              "render": function(data, type, row) {
                return row.profile
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
                return `
                  <a href="<?php echo site_url(); ?>/CPeople/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CPeople/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deletePeople(`+row.id+`);">
                      <i class='fa fa-trash-o'></i> Eliminar
                  </a>`;
              }
            }
           ],
        });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-people').addClass('menu-open');
      $('#ul-people').css('display', 'block');
    });

    function deletePeople(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CPeople/deletePeople",{
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
