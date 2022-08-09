<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-usd" aria-hidden="true"></i>
              <h3 class="box-title">Precios</h3>
          </div>


          <div class="box-body">
                <section class="content">
                <hr>
                <div id="div-table">
                  <table id="table-prices" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Precio</th>
                        <!-- <th>Acción</th> -->
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
            </section>
          </div>
          <div class="box-footer"></div>
        </div>
      </div>
    </div>
  </section>

</div>

<?php $this->view('footer');?>

<script>
  var company;
    $(document).ready(function() {
      company = "<?php echo $user_company[0]->id; ?>";
      loadDataTable();

    });


    function loadDataTable()
    {
      $.ajax({
        url: site_url + '/CPrices/getType_Rate',
        type: 'post',
        data: {company: company},
        success: function(data)
        {
          if(data == '1')
          {
            $('#form-upload_file').css('display','block');
            $('#div-addSize').css('display','none');

            $('#div-table').html('<table id="table-prices" class="table table-striped table-bordered table-condensed" style="width:100%;"><thead><tr><th width="10%">ID</th><th>Origen</th><th>Destino</th><th>Precio</th><th>Acción</th></tr></thead><tbody></tbody></table>');
            $('#table-prices').DataTable({
                "lengthMenu": [[2000, 2500, 5000, -1], [2000, 2500, 5000, "All"]],
                'responsive': true,
                'paging': true,
                'info': false,
                'filter': false,
                'ordering': true,
                // 'stateSave': true,
                'processing':true,
                'serverSide':true,
                'language': {
                  "url": base_url + "assets/Spanish.json"
                },
                "order": [[0, "asc"]],
                'ajax': {
                  "url": site_url + "/CPrices/datatable",
                  "type":"POST",
                  "data":{company: company},
                },
                "columns": [
                  { "data": "ID"},
                  { "data": "Origen" },
                  { "data": "Destino" },
                  { "data": "Precio" },
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
                      return row.from
                    }
                  },
                  {
                    "targets": [2],
                    "orderable": true,
                    "render": function(data, type, row) {
                      return row.to
                    }
                  },
                {
                    "targets": [3],
                    "orderable": true,
                    "render": function(data, type, row) {
                      return row.value
                    }
                  },
                  /*{
                    "targets": [4],
                    "orderable": false,
                    "render": function(data, type, row) {
                      return `
                        <a href="<?php //echo site_url(); ?>/CPrices/edit?id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                            <i class='fa fa-pencil-square-o'></i> Editar
                        </a>`;
                    }
                  }*/
                ],
              });
          }
          else
          {
            $('#form-upload_file').css('display','none');
            $('#div-addSize').css('display','block');

            $('#div-table').html('<table id="table-prices" class="table table-striped table-bordered table-condensed" style="width:100%;"><thead><tr><th width="10%">ID</th><th>Tamaño</th><th>Precio</th><th>Acción</th></tr></thead><tbody></tbody></table>');
            $('#table-prices').DataTable({
                "lengthMenu": [[2000, 2500, 5000, -1], [2000, 2500, 5000, "All"]],
                'responsive': true,
                'paging': true,
                'info': false,
                'filter': false,
                'ordering': true,
                // 'stateSave': true,
                'processing':true,
                'serverSide':true,
                'language': {
                  "url": base_url + "assets/Spanish.json"
                },
                "order": [[0, "asc"]],
                'ajax': {
                  "url": site_url + "/CPrices/datatable",
                  "type":"POST",
                  "data":{company: company},
                },
                "columns": [
                  { "data": "ID"},
                  { "data": "Tamaño" },
                  { "data": "Precio" },
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
                      return row.size
                    }
                  },
                  {
                    "targets": [2],
                    "orderable": true,
                    "render": function(data, type, row) {
                      return row.value
                    }
                  },
                  /*
                  {
                    "targets": [3],
                    "orderable": false,
                    "render": function(data, type, row) {
                      return `
                        <a href="<?php //echo site_url(); ?>/CPrices/edit?companies_id=`+$company+`&id=`+row.id+`" class="btn btn-warning btn-xs" role="button">
                            <i class='fa fa-pencil-square-o'></i> Editar
                        </a>`;
                    }
                  }
                  */
                ],
              });
          }
        }
      });

    }



</script>

</body>
</html>
