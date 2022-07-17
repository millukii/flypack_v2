<?php

$options;
$codes = [];

if (!empty($this->session->userdata('options'))) {

    $options = $this->session->userdata('options');

    for ($i = 0; $i < count($options); $i++) {
        array_push($codes, $options[$i]['code']);
    }
}

?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">


    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

    <?php if ($this->session->userdata("rol_id") == 1) {
    ?>
            <li class="treeview" id="li-configuration">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Configuración</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" id="ul-configuration">

                  <li class="treeview" id="li-companies">
                    <a href="#">
                      <i class="fa fa-circle-o"></i> <span>Empresas</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" id="ul-companies">
                        <li><a href="<?php echo site_url() ?>/CCompany/index"><i class="fa fa-circle-o"></i>Empresas</a></li>
                    </ul>
                  </li>
                  <!--
                  <li class="treeview" id="li-people">
                    <a href="#">
                      <i class="fa fa-circle-o"></i> <span>Personas</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" id="ul-people">
                        <li><a href="<?php //echo site_url() ?>/CProfiles/index"><i class="fa fa-circle-o"></i>Perfiles</a></li>

                        <li><a href="<?php //echo site_url() ?>/CPeople/index"><i class="fa fa-circle-o"></i>Personas</a></li>
                    </ul>
                  </li>
                  -->
                  <li class="treeview" id="li-users">
                    <a href="#">
                      <i class="fa fa-circle-o"></i> <span>Usuarios</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" id="ul-users">
                        <li><a href="<?php echo site_url() ?>/CRoles/index"><i class="fa fa-circle-o"></i>Roles</a></li>
                        <li><a href="<?php echo site_url() ?>/CUsers/index"><i class="fa fa-circle-o"></i>Usuarios</a></li>
                    </ul>
                  </li>

                </ul>
            </li>

    <?php }?>

    <?php if ($this->session->userdata("rol_id") == 1 || $this->session->userdata("rol_id") == 2) {?>
            <li  id="li-ot">
              <a href="<?php echo site_url() ?>/CShipping/index">
                <i class="fa fa-circle-o"></i> <span>Ordenes de Transporte</span>
              </a>
            </li>


             <?php if ($this->session->userdata("rol_id") == 1) {?>
            <li  id="li-prices">
              <a href="<?php echo site_url() ?>/CPrices/index">
                <i class="fa fa-circle-o"></i> <span>Precios</span>

              </a>
            </li>
            <?php }?>

            <?php if ($this->session->userdata("rol_id") == 2) {?>
            <li  id="li-prices">
              <a href="<?php echo site_url() ?>/CPrices/indexclient">
                <i class="fa fa-circle-o"></i> <span>Precios</span>

              </a>
            </li>
            <?php }?>

    <?php }?>
        <?php if ($this->session->userdata("rol_id") == 1 || $this->session->userdata("rol_id") == 3) {?>
            <li  id="li-my_shippings">
              <a href="<?php echo site_url() ?>/CShipping/getMyShippings">
                <i class="fa fa-circle-o"></i> <span>Mis Envíos</span>
              </a>
            </li>

            <li  id="li-my_shippings">
              <a href="<?php echo site_url() ?>/CShipping/addPickup">
                <i class="fa fa-circle-o"></i> <span>Generar Retiros</span>
              </a>
            </li>
    <?php }?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
