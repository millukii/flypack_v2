<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-users"></i>
              <h3 class="box-title">Perfiles</h3>
          </div>

          <div class="box-body">
            <section class="content">
                <a href="<?php echo site_url() ?>/CProfiles/add" class="btn btn-primary">Agregar</a><br><hr>
                <table id="table-profiles" class="table table-striped table-bordered table-condensed" style="width:100%;">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th>Perfil usuario</th>
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
      $('#table-profiles').DataTable({
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
            "url": site_url + "/CProfiles/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Perfil" },
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
                return row.profile
              }
            },
            {
              "targets": [2],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <a href="<?php echo site_url(); ?>/CProfiles/view?id=`+row.id+`" class="btn btn-primary btn-xs" role="button">
                    <i class='fa fa-search'></i> Ver
                  </a>
                  <a href="<?php echo site_url(); ?>/CProfiles/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                      <i class='fa fa-pencil-square-o'></i> Editar
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" role="button" onclick="deleteProfile(`+row.id+`);">
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

    function deleteProfile(id)
    {
      if (confirm('¡Seguro de eliminar!'))
      {
        $.post(
          site_url + "/CProfiles/deleteProfile",{
            id  :   id
        },
        function(data)
        {
          if (data == 1)
             window.location.reload();
          else
            alert("Error en el proceso...")
        });
      }
    }
</script>

</body>
</html>
