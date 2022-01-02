<?php
if(empty($this->session->userdata('users_id')))
  header('Location: '.site_url());

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Flypack</title>
  <!-- <link href="<?php //echo base_url();?>assets/img/logo_bordachar.png" type="image/x-icon" rel="icon"/>
  -->
  <!-- <link href="<?php //echo base_url();?>assets/img/logo_bordachar.png" type="image/x-icon" rel="shortcut icon"/>
  -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/responsive.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/treeview/bootstrap-theme.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/treeview/gijgo.min.css" />
  <style type="text/css">
    .white-box 
    {
      background: #ffffff;
      padding: 15px;
      margin-bottom: 30px;
    }
    .white-box h3 
    {
      margin: 0px 0px 12px;
      font-weight: 500;
      font-size: 16px;
    }
  </style>
  <!-- Google Font -->
  <!-- ARREGLAR ESTO 30 / 01/ 2019  -->
  
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/fonts_google.css">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/wizard.css">
  

  <script> var site_url = '<?php echo site_url() ?>'; </script>
  <script> var base_url = '<?php echo base_url() ?>'; </script>

  
  
</head>
<body class="hold-transition skin-blue sidebar-mini">

  


<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-tachometer"></i>  <b>Flypack</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-tachometer"></i> <b>Flypack</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="<?php //echo base_url()?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <span class="hidden-xs">
                <?php



                    $name = ''; 
                    if($this->session->userdata('name'))
                    {
                      $name .= $this->session->userdata('name').' ';
                    }

                    if($this->session->userdata('lastname'))
                    {
                      $name .= $this->session->userdata('lastname');
                    }

                    echo 'Bienvenido '.$name;
                  ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <li class="user-header">
                <font color="white"><i class="fa fa-user fa-5x"></i></font>
                <p>
                  <?php
                    $name = ''; 
                    if($this->session->userdata('name'))
                    {
                      $name .= $this->session->userdata('name').' ';
                    }

                    if($this->session->userdata('lastname'))
                    {
                      $name .= $this->session->userdata('lastname');
                    }

                    echo 'Bienvenido'.$name;
                  ?>
                  <small> 
                  <?php
                    if($this->session->userdata('rol'))
                      echo $this->session->userdata('rol');
                    if($this->session->userdata('email'))
                      echo '<br>'.$this->session->userdata('email');
                  ?> </small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <!--
                  <a href="<?php //echo site_url('CWelcome/Profile') ?>" class="btn btn-default btn-flat">Configuración</a>
                  -->
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url("CWelcome/Logout");?>" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        -->
        </ul>
      </div>
    </nav>
  </header>


<script type="text/javascript">

  function checkRutHeader(rut) 
  {
        // Despejar Puntos
        var valor = rut.value.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        
        // Aislar Cuerpo y Dígito Verificador
        var cuerpo = valor.slice(0,-1);
        var dv = valor.slice(-1).toUpperCase();
        // Formatear RUN
        rut.value = cuerpo + '-'+ dv
        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if(cuerpo.length < 7) 
        {
            rut.setCustomValidity("RUT Incompleto");
            rut.setCustomValidity('');
            cuerpo = '';
            dv = '';
            rut.value = '';
            return false;
        }
        else
        {
            // Calcular Dígito Verificador
            suma = 0;
            multiplo = 2;
            
            // Para cada dígito del Cuerpo
            for(i=1;i<=cuerpo.length;i++) {
            
                // Obtener su Producto con el Múltiplo Correspondiente
                index = multiplo * valor.charAt(cuerpo.length - i);
                
                // Sumar al Contador General
                suma = suma + index;
                
                // Consolidar Múltiplo dentro del rango [2,7]
                if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
          
            }
            
            // Calcular Dígito Verificador en base al Módulo 11
            dvEsperado = 11 - (suma % 11);
            
            // Casos Especiales (0 y K)
            dv = (dv == 'K')?10:dv;
            dv = (dv == 0)?11:dv;
            
            // Validar que el Cuerpo coincide con su Dígito Verificador
            if(dvEsperado != dv) 
            { 
                rut.setCustomValidity("RUT Inválido");
                rut.setCustomValidity('');
                cuerpo = '';
                dv = '';
                rut.value = '';
                return false;
            }
            // Si todo sale bien, eliminar errores (decretar que es válido)
            rut.setCustomValidity('');
            return true;
        }
    }

    
</script>
