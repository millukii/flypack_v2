
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">


    <h3> <i class="fa fa-share" aria-hidden="true"></i> Accesos directos</h3>
    <div class="row">
      
    <?php if ($this->session->userdata("rol_id") == 1 ||  $this->session->userdata("rol_id") == 2){     ?>
      <div class="col-md-3">
        <div class="white-box">
            <center>
            <div class="card" style="width: 20rem;">
              <center>
                <i class="fa fa-rocket fa-5x" aria-hidden="true"></i>
              
              <div class="card-block">
                <h4 class="card-title">Ordenes Transporte (OT)</h4>
                <a href="<?php echo site_url() ?>/CShipping/index" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
              <br><br>
              </div>
              </center>
            </div>
          </center>
        </div>
      </div>
      <?php if ($this->session->userdata("rol_id") == 2){     ?>
      <div class="col-md-3">
          <div class="white-box">
              <center>
              <div class="card" style="width: 20rem;">
                <center>
                  <i class="fa fa-usd fa-5x" aria-hidden="true"></i>
                
                <div class="card-block">
                  <h4 class="card-title">Precios</h4>
                  <a href="<?php echo site_url() ?>/CPrices/indexclient" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
                <br><br>
                </div>
                </center>
              </div>
            </center>
          </div>
      </div>
      <?php }?>
      <div class="col-md-3">
          <div class="white-box">
              <center>
              <div class="card" style="width: 20rem;">
                <center>
                  <i class="fa fa-hand-stop-o fa-5x" aria-hidden="true"></i>
                
                <div class="card-block">
                  <h4 class="card-title">Nueva OT</h4>
                  <a href="<?php echo site_url() ?>/CShipping/add" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
                <br><br>
                </div>
                </center>
              </div>
            </center>
          </div>
      </div>
      <?php  }    ?>

      <?php if ($this->session->userdata("rol_id") == 1){     ?>
        <div class="col-md-3">
            <div class="white-box">
                <center>
                <div class="card" style="width: 20rem;">
                  <center>
                    <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                  
                  <div class="card-block">
                    <h4 class="card-title">Personas</h4>
                    <a href="<?php echo site_url() ?>/CPeople/index" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
                  <br><br>
                  </div>
                  </center>
                </div>
              </center>
            </div>
        </div>
    

        <div class="col-md-3">
            <div class="white-box">
                <center>
                <div class="card" style="width: 20rem;">
                  <center>
                    <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                  
                  <div class="card-block">
                    <h4 class="card-title">Usuarios</h4>
                    <a href="<?php echo site_url() ?>/CUsers/index" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
                  <br><br>
                  </div>
                  </center>
                </div>
              </center>
            </div>
        </div>
    


    </div>
    <div class="row">

      
    <?php  }    ?>

    <?php if ($this->session->userdata("rol_id") == 1 ||  $this->session->userdata("rol_id") == 2 ||  $this->session->userdata("rol_id") == 3){     ?>
      
        <div class="col-md-3">
            <div class="white-box">
                <center>
                <div class="card" style="width: 20rem;">
                  <center>
                  <i class="fa fa-cog fa-5x" aria-hidden="true"></i>
                  
                  <div class="card-block">
                    <h4 class="card-title">Mi Perfil</h4>
                    <a href="<?php echo site_url() ?>/CWelcome/profile" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
                  <br><br>
                  </div>
                  </center>
                </div>
              </center>
            </div>
        </div>
      <?php  }    ?>
    <?php if ($this->session->userdata("rol_id") == 3){     ?>

      <div class="col-md-3">
        <div class="white-box">
            <center>
            <div class="card" style="width: 20rem;">
              <center>
                <i class="fa fa-rocket fa-5x" aria-hidden="true"></i>
              
              <div class="card-block">
                <h4 class="card-title">Mis Envíos</h4>
                <a href="<?php echo site_url() ?>/CShipping/index" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
              <br><br>
              </div>
              </center>
            </div>
          </center>
        </div>
      </div>

      <div class="col-md-3">
        <div class="white-box">
            <center>
            <div class="card" style="width: 20rem;">
              <center>
                <i class="fa fa-qrcode fa-5x" aria-hidden="true"></i>
              
              <div class="card-block">
                <h4 class="card-title">Generar Retiros</h4>
                <a href="<?php echo site_url() ?>/CShipping/addPickup" style="background-color: #3c8dbc;" class="btn"><font color="white">Acceder</font></a>
              <br><br>
              </div>
              </center>
            </div>
          </center>
        </div>
      </div>
    <?php  }    ?>
    </div>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row"></div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->