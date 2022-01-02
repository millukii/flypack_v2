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
                  
                  <?php echo $ot; ?>
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
