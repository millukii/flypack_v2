<?php
include_once '/home/flypackroot/public_html/flypack_v2/updatePois/conexion.php';
ini_set('date.timezone', 'America/Santiago');
//delete
$SQL = "delete from shipping_request where status = 1";
$result = $conexion->query($SQL);
?>