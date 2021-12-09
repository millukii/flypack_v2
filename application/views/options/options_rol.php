<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-cogs"></i>
            <h3 class="box-title">Opciones - Rol</h3>
            </div>

            <div class="box-body">
              <section class="content">
                  <select class="form-control" id="select-rol" name="select-rol" onchange="readOptions_Rol(this.value);">
                    <option value="0">Seleccione una opción</option>
                    <?php
                    if(!empty($roles))
                    {
                      foreach($roles as $r)
                        echo '<option value="'.$r['id'].'">'.$r['rol'].'</option>';
                    }
                    ?>
                  </select>
                  <span></span>
                  <br>
                 
                   <button class="btn btn-primary" onclick="checkall();">todos / ninguno</button>&nbsp;&nbsp;
                   <button class="btn btn-success" onclick="updateOption_Rol();">Guardar</button>

                  <br>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <table id="table-options_rol" class="table table-striped table-bordered table-condensed" style="width:100%;">
                      <thead>
                        <tr>
                          <th>*</th>
                          <th>N°</th>
                          <th>Código</th>
                          <th>Opción</th>
                          <th>Descripción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i = 1;
                        if(!empty($options))
                        {
                          foreach($options as $opt)
                          {
                            echo '<tr><td><input type="checkbox" class="check-options" name="'.$opt['id'].'" id="input-option-'.$opt['id'].'"></td><td>'.$i.'</td><td>'.$opt['code'].'</td><td>'.$opt['option'].'</td><td>'.$opt['description'].'</td></tr>';
                            $i++;
                          }
                        }
                        ?>
                      </tbody>
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
    
    var init = false; 
    var options = [];

    $(document).ready(function()
    {
      $('#table-options_rol').DataTable({
        'language': {
            "url": base_url + "assets/Spanish.json"
          },
          'paging': false
      });

      $('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-options').addClass('menu-open');
      $('#ul-options').css('display', 'block');
    });

    function checkall()
    {
      var check_options = document.getElementsByClassName('check-options');

      if(init == false)
      {
        for(var i=0; i<check_options.length;i++)
        {
          $(check_options[i]).prop('checked', true);
        }

        init = true;
      }
      else
      {
        for(var i=0; i<check_options.length;i++)
        {
          $(check_options[i]).prop('checked', false);
        }

        init = false;
      }

    }

    function readOptions_Rol(value)
    {
      var check_options = document.getElementsByClassName('check-options');
      for(var i=0; i<check_options.length;i++)
        $(check_options[i]).prop('checked', false);

      $.ajax({
        url: site_url + '/COptions/getOptions_Rol',
        type: 'post',
        dataType: 'json',
        data: {roles_id: value},
        success: function(data)
        {
          if(data != null && data.length > 0)
          {
            for(var i=0; i<data.length;i++)
              $('#input-option-'+data[i]['options_id']).prop('checked', true);
          }
        }
      });
    }

    function updateOption_Rol()
    {
      var roles_id = $('#select-rol').val();
      var check_options = document.getElementsByClassName('check-options');
      if(roles_id != '0')
      {
        for(var i=0; i<check_options.length;i++)
        {
          if($(check_options[i]).prop('checked'))
          {
            var opt = $(check_options[i]).attr('name');
            options.push(opt);
          }
        }

        $.ajax({
          url: site_url + '/COptions/updateOptions_Rol',
          type: 'post',
          dataType: 'text',
          data: {roles_id: roles_id, options: options},
          success: function(data)
          {
            location.reload();
          }
        });
      }
      else
        alert('Debe seleccionar un Rol.');
    }
      
</script>

</body>
</html>
