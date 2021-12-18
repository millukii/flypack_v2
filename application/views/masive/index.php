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

                    <div class="form-group">
                      <label for="companies" class="col-sm-2 control-label">Perfil</label>
                      <div class="col-sm-5">
                        <select name="select-profiles" id="select-profiles" class="form-control" required>
                          <option value="">Seleccione una opción</option>
                          <?php
                          $this->db->select('id, profile');
                          $this->db->from('profiles');
                          $this->db->order_by('profile', 'asc');

                          $res = $this->db->get()->result_array();
                          if(!empty($res))
                          {
                            foreach($res as $r)
                            {
                              echo '<option value="'.$r['id'].'">'.$r['profile'].'</option>';
                            }
                          }
                          ?>

                        </select>
                      </div>
                    </div>
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

        var profiles_id  = $("#select-profiles").val();

        var file_upload = document.getElementsByClassName('upi');
        var elementos = new FormData();
        for(var j = 0; j < file_upload.length; j++){
            var archivo = file_upload[j].files;
            for(var i = 0; i < archivo.length; i++){
                elementos.append('archivo'+i, archivo[i]);
            }
        }

        $.ajax({
                url: site_url + '/CMasive/excelfile?profile='+profiles_id,//upload
                type: 'post',
                contentType: false,
                data: elementos,
                processData: false,
                cache: false,
                success: function(dato)
                {
                  if (dato == 1) {
                    window.location.replace(site_url+"/CMasive/index/");
                  }
                  else if (dato != 1) {
                    alert("Error durante la carga masiva");
                    window.location.replace(site_url+"/CMasive/index/");
                  }
                }
            });
        
      });


      $('#li-utils').addClass('menu-open');
      $('#ul-utils').css('display', 'block');
    });

</script>

</body>
</html>
