<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
               <i class="fa fa-file-text"></i>
            <h3 class="box-title">Reporte Resumen Diario</h3>
            </div>

            <div class="box-body">
              <section class="content">

                  <div class="col-sm-12">
                    <select class="form-control" id="select-year" name="select-year">
                      <option value="">Seleccione Temporada</option>
                      <?php
                      for($i = 2019; $i <= date('Y'); $i++)
                      {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                      ?>
                    }
                    </select>
                    <br>
                    <button onclick="generateReportResponse();" class="btn btn-primary btn-lg btn-block">Generar <i class="fa fa-refresh" aria-hidden="true"></i></button>
                    <hr>

                    <center>
                    
                    <iframe  width="100%" height="500" src="" id="iframe-pdf" name="iframe-pdf"></iframe>
                    </center>

                  </div>

              </section>
            </div>
            <div class="box-footer"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->view('footer'); ?>

<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<!-- <script src="<?php //echo base_url();?>assets/js/buttons.flash.min.js"></script> -->
<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>


<script>
    $(document).ready(function()
    {

      $('#li-production').addClass('menu-open');
      $('#ul-production').css('display', 'block');
    });

    function generateReportResponse()
    {
      var year = $('#select-year').val();

      if(year != '')
      {
        /*
        $.ajax({
          url: site_url + '/CProduction/getReportResponse',
          type: 'post',
          dataType: 'json',
          data: {year: year},
          success: function(data)
          {
            console.log(data);
          }
        });
        */
        $('#iframe-pdf').attr('src', site_url + '/CProduction/getReportResponse?year='+year);
      }
      else
        alert('Seleccione una temporada.');
    }

    function separatorMiles(x)
    {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

</script>

</body>
</html>
