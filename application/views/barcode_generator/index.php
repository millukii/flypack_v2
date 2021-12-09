<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Generar Código de Barras
      <!-- <small>Control panel</small> -->
      
      <br>
      <!--
      <button type="button" class="btn btn-primary" onclick="generateAllPeople();">Generación Masiva</button><br>
      -->
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <fieldset>
        <legend>Opciones</legend>
        <table class="table">
          <tr>
            <td>Intervalo</td>
            <td>
              <input class="form-control" type="number" name="input-from" id="input-from" value="0">
            </td>
            <td>
              <input class="form-control" type="number" name="input-to" id="input-to" value="0">
            </td>
            <td>
              <button type="button" class="btn btn-primary" onclick="generateIntervalPeople();">Generar</button>
            </td>
          </tr>
          <tr>
            <td>Todos</td>
            <td align="left"><button type="button" class="btn btn-primary" onclick="generateAllPeople();">Generar</button></td>
          </tr>
        </table>
      </fieldset>
     
      <hr>
      <center>
        <h5 id="h5-title">Esperando generación de Código de Barras</h5>
        
        <iframe  width="100%" height="500" src="" id="iframe-pdf" name="iframe-pdf"></iframe>

      </center>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer');?>

<script type="text/javascript">
  var cuerpo;
  var dv;

  $(document).ready(function(){

    $("#form-generate_barcode").submit(function(event) {
      event.preventDefault();
      cuerpo = $('#inputrut').val();
      $('#iframe-pdf').attr('src', site_url + '/CBarCode/GeneratePeople?rut='+cuerpo);
    });

    $('#li-utils').addClass('menu-open');
    $('#ul-utils').css('display', 'block');

  });

  function clearBarCode()
  {
    $('#inputrut').val('');
    $('#h5-title').html('Esperando generación de Código de Barras');
    setTimeout(function(){ $('#inputrut').focus(); }, 1);
  }


  function generateAllPeople()
  {
    $('#iframe-pdf').attr('src', site_url + '/CBarCode/GenerateAllPeople');
  }

  function generateIntervalPeople()
  {
    var from = parseInt($('#input-from').val());
    var to = parseInt($('#input-to').val());

    if(from <= to && from > 0 && to > 0)
      $('#iframe-pdf').attr('src', site_url + '/CBarCode/GenerateIntervalPeople?from='+from+'&&to='+to);
    else
      alert('Debe existir un intervalo válido y deben ser mayor a 0.');
    
  }
</script>