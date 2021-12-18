<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-file-text"></i>
            <h3 class="box-title">Historial BackUps SQL</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <a href="<?php echo site_url() ?>/CExportSQL/add" class="btn btn-primary">Agregar</a>
                  <br>
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-exports_sql" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Ruta</th>
                          <th>Creación</th>
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
      $('#table-exports_sql').DataTable({
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
            "url": site_url + "/CExportSQL/datatable",
            "type":"POST",
          },
          "columns": [
            { "data": "ID"},
            { "data": "Nombre" },
            { "data": "Ruta" },
            { "data": "Creación" },
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
                return row.name
              }
            },
            {
              "targets": [2],
              "orderable": true,
              "render": function(data, type, row) {
                return row.path
              }
            },
            {
              "targets": [3],
              "orderable": true,
              "render": function(data, type, row) {
                return row.created 
              }
            },
            {
              "targets": [4],
              "orderable": false,
              "render": function(data, type, row) {
                return `
                  <button class="btn btn-primary btn-xs" role="button" onclick="automatic_export(`+row.id+`);">
                    <i class='fa fa-hand-stop-o'></i> Seleccionar
                  </button>
                  `;
              }
            }
           ],
        });

      $('#li-utils').addClass('menu-open');
      $('#ul-utils').css('display', 'block');

    });
    
    function automatic_export(id)
    {
        var c = confirm('Confirme la selección del proceso de restauración de Back-Up.\nPara este proceso se reestableceran los datos del Back-Up seleccionado.');
        if(c)
        {
            $.post(
				site_url + "/CExportSQL/import_database",{
					id 				: 	id
				},
				function(data)
				{
				    /*
					if (data == 1)
						window.location.replace(site_url+"/CExportSQL/index");
					else
						alert("Error en el proceso de Back-Up.")
					*/
				    alert("Proceso de restauración completo");	
				    window.location.replace(site_url);
				}
			);
        }
        
    }

</script>

</body>
</html>
