<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Ingreso Resumen Diario</h3>
            </div>

            <form class="form-horizontal" id="form-response">
              <div class="box-body">

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-3">
                    <input type="date" class="form-control" name="input-date" id="input-date" value="<?php echo date('Y-m-d');?>" required>
                  </div>
                </div>


                <div class="form-group">
                  <label for="companies" class="col-sm-2 control-label">Producto | Variedad</label>
                  <div class="col-sm-3">
                    <select name="select-products" id="select-products" class="form-control" required>
                      <?php
                      $this->db->select('products.id as id, products.product as product, varieties.variety as variety');
                      $this->db->from('products');
                      $this->db->join('varieties', 'varieties.id = products.varieties_id');
                      $this->db->order_by('products.product');
                      $res = $this->db->get()->result_array();
                      if(!empty($res))
                      {
                        foreach($res as $r)
                        {
                          echo '<option value="'.$r['id'].'">'.$r['product'].' | '.$r['variety'].'</option>';
                        }
                      }
                      ?>
                    </select>

                  </div>
                  <div class="col-sm-3">
                    <button type="button" title="buscar" onclick="loadData();" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
                <hr>
                 </form>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Peso (KG)</label>
                  <div class="col-sm-3">
                    <input disabled value="0" class="form-control" type="text" id="input-weight" name="input-weight" onkeyup="calculateKPC(this.value)">
                  </div>
                </div>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Cantidad (Cajas)</label>
                  <div class="col-sm-3">
                    <input readonly type="number" class="form-control" name="input-quantity" id="input-quantity" value="0" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Peso / Cantidad (KPC)</label>
                  <div class="col-sm-3">
                    <input readonly type="text" class="form-control" name="input-w_q" id="input-w_q" value="0" required>
                  </div>
                </div>
                
              </div>
           

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" onclick="addResponse();">Guardar</button>
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
      $("#form-response").submit(function(event) {
        event.preventDefault();
        loadForm();
      });
      
      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function loadData()
    {
      $('#input-quantity').attr('disabled', true);
      $('#input-weight').attr('disabled', true);
      $('#input-w_q').attr('disabled', true);
      $('#input-quantity').val(0);
      $('#input-weight').val(0);
      $('#input-w_q').val(0);

      var date = $('#input-date').val();
      var product = $('#select-products').val();

      $.ajax({
        url: site_url + '/CProduction/getRenderResponse',
        type: 'post',
        dataType: 'text',
        data: {date: date, product: product},
        success: function(data)
        {
          var quantity = parseInt(data);
          if(quantity > 0)
          {
            $('#input-quantity').val(quantity);
           

            $('#input-weight').attr('disabled', false);

             $('#input-weight').focus();
          }
          else
            alert('No hay registros de cosecha para esa fecha y producto.');
        }
      });
    }

    function calculateKPC(value)
    {
      var quantity = $('#input-quantity').val();
      var res = 0;

      if($('#input-weight').val().trim().length > 0)
      {
        if(value < 0)
        {
          $('#input-weight').val('0');
          $('#input-w_q').val('0');
        }
        else
        {
          res = value / quantity;
          $('#input-w_q').val(Math.round(res * 100) / 100);
        }
      }
      
    }

    function addResponse()
    {
      var date = $('#input-date').val();
      var product = $('#select-products').val();

      var quantity = $('#input-quantity').val();
      var kg = $('#input-weight').val();

      var kpc = $('#input-w_q').val();

      if(quantity > 0 && kg > 0 && kpc > 0)
      {
        //alert(quantity+'   '+kg+'     '+kpc);
        $.ajax({
          url: site_url + '/CProduction/addResponse',
          type: 'post',
          dataType: 'text',
          data: {date: date, products_id: product, quantity: quantity, weight: kg, w_q: kpc},
          success: function(data)
          {
            if (data == 1) 
              window.location.replace(site_url+"/CProduction/response");
            else
              alert("Ya existe un registro ingresado para esa variedad y fecha");
          }
        });
      }
      else
        alert('Verifique los datos ingresados.');
    }
</script>

</body>
</html>
