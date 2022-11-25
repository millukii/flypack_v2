<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-list"></i>
            <h3 class="box-title">Cargas Masivas Personas</h3>
            </div>

            <form enctype="multipart/form-data" id="form-masive" method="post">
              <div class="box-body">
                <section class="content">

                    <p>Descargue el formato para cargar de manera masiva las OTs. <a download href="../../files/formato_ordenes.xlsx">Descargar</a></p>
                    <br>
                    <div class="form-group">
                      <label for="upload" class="col-sm-2 control-label">Carga excel</label>
                      <div class="col-sm-5">
                        <input type="file" class="form-control upi" name="file" id="file" required>
                      </div>
                    </div>
                    <br>

                    <input type="submit" class="btn btn-primary" value="Guardar">
                </section>
              </div>
            </form>
            <div class="box-footer">
              
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script>
    $(document).ready(function()
    {

      $("#form-masive").submit(function(event) {
        event.preventDefault();

        var file_upload = document.getElementsByClassName('upi');
        var elementos = new FormData();
        for(var j = 0; j < file_upload.length; j++){
            var archivo = file_upload[j].files;
            for(var i = 0; i < archivo.length; i++){
                elementos.append('archivo'+i, archivo[i]);
            }
        }

        $.ajax({
                url: site_url + '/CShipping/excelfile',//upload
                type: 'post',
                contentType: false,
                data: elementos,
                processData: false,
                cache: false,
                success: function(dato)
                {
                  if (dato == '1') {
                    window.location.replace(site_url+"/CShipping/massive");
                  }
                  else if (dato != '1') {
                    alert("Error durante la carga masiva");
                    //window.location.replace(site_url+"/CShipping/massive");
                  }
                }
            });
        
      });
    });

</script>

</body>
</html>
