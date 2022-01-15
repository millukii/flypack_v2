<div class="content-wrapper">
	<section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle">
              <i class="fa fa-list"></i>
            <h3 class="box-title">Estado OT</h3>
            </div>

            <div class="box-body">
              <section class="content">
                 
                  <span></span>
                  <div class="pull-right">
                    <span>&nbsp;&nbsp;</span>
                  </div>
                  <br>
                  <?php 
                    $ordenes_transporte = json_decode($ordenes_transporte, true); 

                    foreach($ordenes_transporte['data'] as $ot)
                    {

                      echo '<div class="col-md-3 col-lg-3 col-sm-3">
                              <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">OT '.$ot['code'].' '.$ot['date'].'</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                                  <a href="#" class="btn btn-primary">'.$ot['operation'].'</a>
                                </div>
                              </div>
                            </div>';
                      
                    }
                  
                  ?>
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
      

      /*$('#li-configuration').addClass('menu-open');
      $('#ul-configuration').css('display', 'block');

      $('#li-shipping').addClass('menu-open');
      $('#ul-shipping').css('display', 'block');
      */
    });

</script>

</body>
</html>
