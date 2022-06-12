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
    }
    legend
    {
        font-size:14px;
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
      margin-bottom: 20px;
      border-spacing: 0;
      border-collapse: collapse;
      display: table;
      border-collapse: separate;
      border-spacing: 2px;
      border-color: grey;
      font-size: 11px;
  }
</style>
</head>
<body>
<center>
	<h6>
		<?php
		if(!empty($receiver_name))
			echo $receiver_name;
		?>
	</h6>
    <p>
		<?php
		if(!empty($address))
			echo $address;
		?>
	</p>
    <p>
		<?php
		if(!empty($destination))
			echo $destination;
		?>
	</p>
    <p><b>
		<?php
		if(!empty($country))
			echo $country;
		?>
	</b></p>
    <p>
		<?php
		if(!empty($receiver_phone))
			echo $receiver_phone;
        echo '&nbsp;&nbsp;&nbsp;';
        if(!empty($order_nro))
			echo $order_nro;
		?>
	</p>
</center>
</body>
</html>