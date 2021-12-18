<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Editar Resumen Diario # <?php if(!empty($response[0]['id'])) echo $response[0]['id'];?></h3>
            </div>

            <form class="form-horizontal" id="form-response">
              <div class="box-body">

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-3">
                    <input readonly type="date" class="form-control" name="input-date" id="input-date" value="<?php if(!empty($response[0]['date'])) echo $response[0]['date'];?>" required>
                  </div>
                </div>


                <div class="form-group">
                  <label for="companies" class="col-sm-2 control-label">Producto | Variedad</label>
                  <div class="col-sm-3">
                    <select disabled name="select-products" id="select-products" class="form-control" required>
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

                </div>
                <hr>
                 </form>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Peso (KG)</label>
                  <div class="col-sm-3">
                    <input value="<?php if(!empty($response[0]['weight'])) echo $response[0]['weight'];?>" class="form-control" type="text" id="input-weight" name="input-weight" onkeyup="calculateKPC();">
                  </div>
                </div>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Cantidad (Cajas)</label>
                  <div class="col-sm-3">
                    <input onkeyup="calculateKPC();" type="number" class="form-control" name="input-quantity" id="input-quantity" value="<?php if(!empty($response[0]['quantity'])) echo $response[0]['quantity'];?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="rut" class="col-sm-2 control-label">Peso / Cantidad (KPC)</label>
                  <div class="col-sm-3">
                    <input readonly type="text" class="form-control" name="input-w_q" id="input-w_q" value="<?php if(!empty($response[0]['w_q'])) echo $response[0]['w_q'];?>" required>
                  </div>
                </div>
                
              </div>
           

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" onclick="editResponse();">Guardar</button>
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
      $('#select-products').val('<?php if(!empty($response[0]["products_id"])) echo $response[0]["products_id"];?>');
      
      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });


    function calculateKPC()
    {
      var quantity = $('#input-quantity').val();
      var res = 0;
      var weight = $('#input-weight').val();

      if($('#input-weight').val().trim().length > 0)
      {
        if(weight < 0)
        {
          $('#input-weight').val('0');
          $('#input-w_q').val('0');
        }
        else
        {
          res = weight / quantity;
          $('#input-w_q').val(Math.round(res * 100) / 100);
        }
      }
      
    }

    function editResponse()
    {
      var date = $('#input-date').val();
      var product = $('#select-products').val();

      var quantity = $('#input-quantity').val();
      var kg = $('#input-weight').val();

      var kpc = $('#input-w_q').val();

      if(quantity > 0 && kg > 0 && kpc > 0)
      {
        
        $.ajax({
          url: site_url + '/CProduction/editResponse',
          type: 'post',
          dataType: 'text',
          data: {id: '<?php if(!empty($response[0]['id'])) echo $response[0]['id'];?>',date: date, products_id: product, quantity: quantity, weight: kg, w_q: kpc},
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
