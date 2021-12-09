<!DOCTYPE html>
<html>
<head>
	<title>Listado completo de personas</title>
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
	<h3>
		<?php
		if(!empty($title))
			echo $title;
		?>
	</h3>
</center>
	<table border="1" class="table">
		<?php

		if(!empty($datos))
		{
			$i = 0;
			foreach($datos as $d)
			{
				if($i % 2 == 0)
				{
					echo '<tr>';
					echo '<td width="50%" align="center">';
					echo '<br>';
					echo '<img src="'.$d['image'].'" width="100" />';
					echo '<br>';
					echo '<p>'.$d['name'].' '.$d['lastname'].'</p>';
					echo '</td>';
				}
				else
				{

					echo '<td width="50%" align="center">';
					echo '<br>';
					echo '<img src="'.$d['image'].'" width="100" />';
					echo '<br>';
					echo '<p>'.$d['name'].' '.$d['lastname'].'</p>';
					echo '</td>';
					echo '</tr>';
				}
				
				$i++;
			}
		}

		?>
	</table>
</body>
</html>