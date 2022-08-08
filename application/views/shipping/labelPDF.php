<!DOCTYPE html>
<html>
<head>
	<title>Etiqueta</title>
	<meta charset="utf-8">

	<style type="text/css">
  fieldset 
  {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        //background-color:#f5f5f5;
        padding-left:10px!important;
        width:100%;
        height: 100%;
    }
    legend
    {
        //font-size:20px;
        font-weight:bold;
        margin-bottom: 0px; 
        width: 35%; 
        border: 1px solid #ddd;
        border-radius: 4px; 
        padding: 5px 5px 5px 10px; 
        background-color: #ffffff;
    }
    .form-control {
      background-color: #ffffff;
      border: 1px solid #light;
      border-radius: 0px;
      box-shadow: none;
      color: #565656;
      height: 20px;
      width: 100%;
      max-width: 100%;
      padding: 7px 12px;
      transition: all 300ms linear 0s;
      font-size: 11px;
  }
  .table {
      width: 100%;
      max-width: 100%;
      height: 100%;
      margin-bottom: 20px;
      border-spacing: 0;
      border-collapse: collapse;
      display: table;
      border-collapse: separate;
      border-spacing: 2px;
      border-color: grey;
  }
  body{
    font-size: 32px; 
  }
</style>
</head>
<body>
<img width="120" src="<?php echo base_url();?>assets/img/logo.png?<?php echo date('YmdHis')?>"/>
<center>
  <fieldset>
    <legend>Datos Receptor:</legend>
    <table class="table">
      <tr>
        <td align="center" >
          <?php
            if(!empty($receiver_name))
              echo '<h3 class="fontSizeCustom">'.$receiver_name.'</h3>';
          ?>
        </td>
      </tr>
      <tr>
        <td align="center">
          <?php
            if(!empty($address))
              echo '<b class="fontSizeCustom">'.$address.'</b>';
          ?>
        </td>
      </tr>
      <tr>
        <td align="center">
          <?php
            if(!empty($destination))
              echo $destination;
          ?>
        </td>
      </tr>
      <tr>
        <td align="center">
          <?php
            if(!empty($country))
              echo '<b>'.$country.'</b>';
          ?>
        </td>
      </tr>
      <tr>
        <td align="center">
          <img width="30" src="<?php echo base_url();?>assets/img/phone.png?<?php echo date('YmdHis')?>"/>
          <?php
            if(!empty($receiver_phone))
              echo $receiver_phone;
            
            if(!empty($order_nro))
              echo '&nbsp;&nbsp;&nbsp;<b>#'.$order_nro.'</b>';
          ?>
        </td>
      </tr>
      <tr>
        <td align="center">
          <img width="160" src="<?php echo base_url();?>files/qrs/qr_<?php echo $order_nro;?>.png?<?php echo date('YmdHis')?>"/>
          <br>
          <p style="font-size: 25px;">
            <font color="black">
              <?php echo $order_nro;?>
            </font>
          </p>
        </td>
      </tr>
    </table>
  </fieldset>
</center>
</body>
</html>