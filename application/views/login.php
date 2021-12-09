<html>
<head>
  <title>Flypack</title>
  <!-- ARREGLEAR ESTO-->
   <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/img/logo_md.png">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/dist/css/bootstrap.min.css">
  <script src="<?php echo base_url()?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url()?>assets/jquery/dist/jquery.min.js"></script>
  <style type="text/css">
      body 
      {
        font-size: 12px;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-size: cover;
        background-position: 50% 50%;
        background-image: url('<?php //echo base_url().'/assets/img/background_final.jpg'?>');
        background-repeat:repeat;
      }
      .form-signin input[type="text"] {
          margin-bottom: 5px;
          border-bottom-left-radius: 0;
          border-bottom-right-radius: 0;
      }
      .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
      }
      .form-signin .form-control {
          position: relative;
          font-size: 16px;
          font-family: 'Open Sans', Arial, Helvetica, sans-serif;
          height: auto;
          padding: 10px;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
      }
      .vertical-offset-100 {
          padding-top: 100px;
      }
      .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
        margin: auto;
      }
      .panel {
        margin-bottom: 20px;
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
      }

      .modal-header{
        background-color: #30a5ff;
      }
      .modal-title{
        color: #fff;
      }
      .input-group-addon {
    color: #fff;
    background: #3276B1;
}
  </style>
</head>
<body>
  <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div style="background-color: #0e7d99;" class="panel-heading">                                
                        <div class="row-fluid user-row">

                            <center>
                            <h2>Iniciar Sesion</h2>
                            <br>
                            <?php if(!empty($message)){echo $message;}?>
                            </center>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo site_url('CWelcome/Login');?>" method="post">
                          <div class="form-group">
                            <div class="input-group">

                              <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                              <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                              
                            </div>
                          </div> <!-- /.form-group -->

                          <div class="form-group">
                            <div class="input-group">
                              <label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                              
                            </div> <!-- /.input-group -->
                          </div> <!-- /.form-group -->
                          <input type="hidden" name="ip" id="ip" value="">
                          <input class="btn btn-lg btn-primary btn-block" type="submit" id="login" value="Iniciar">
                                <br>
                          <!-- 
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Remember me
                            </label>
                          </div>
                          --> <!-- /.checkbox -->
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br><br><br><br>
    <footer style="color: white;" class="main-footer-wrapper dark-black">
      <div id="wrapper-footer">
        <div class="bottom-bar-wrapper">
          <div class="bottom-bar-inner">
            <div class="container">
                <div class="row">
                  <div class="col-md-12 sidebar text-center">
                    <aside id="text-12" class="widget widget_text">     
                      <div class="textwidget"><p><b>Copyright &copy; <?php echo date('Y');?> <a href="#">FLYPACK BPLAYER.CL</a>.</strong> Todos los derechos reservados.</b></p>
                      </div>
                    </aside>              
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

<script type="text/javascript">
  $(document).ready(function() {
    //getIp();
  });


  function getIp()
  {
    window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;   //compatibility for firefox and chrome
    var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
    pc.createDataChannel("");    //create a bogus data channel
    pc.createOffer(pc.setLocalDescription.bind(pc), noop);    // create offer and set local description
    pc.onicecandidate = function(ice){  //listen for candidate events
        if(!ice || !ice.candidate || !ice.candidate.candidate)  return;
        var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];
        //document.write('IP: ', myIP);   
        pc.onicecandidate = noop;
        //alert(myIP);
        $('#ip').val(myIP);
        
    };
  }
</script>


</body>
</html>