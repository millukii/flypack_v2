<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Versión</b> 1.0.0
  </div>
  <strong>Copyright &copy; <?php echo date('Y');?> <a href="#">SOCIEDAD AGROCOMERCIAL SANTA PAULA</a>.</strong> Todos los derechos reservados.
</footer>

<script src="<?php echo base_url()?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);

$('#input-entry-rut').keypress(function (e) {
   var key = e.which;
   if(key == 13)  // the enter key code
    {
      //$('input[name = butAssignProd]').click();
      //alert('client enter');
      generateEntryExit();
      return false;  
    }
  });  

</script>
<script src="<?php echo base_url()?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/raphael/raphael.min.js"></script>
<!-- <script src="<?php //echo base_url()?>assets/morris.js/morris.min.js"></script> -->
<script src="<?php echo base_url()?>assets/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()?>assets/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>assets/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url()?>assets/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo base_url()?>assets/moment/min/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url()?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url()?>assets/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url()?>assets/js/adminlte.min.js"></script>
<!-- <script src="<?php //echo base_url()?>assets/js/pages/dashboard.js"></script> -->
<script src="<?php echo base_url()?>assets/js/demo.js"></script>

<script src="<?php echo base_url()?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/treeview/gijgo.min.js"></script>