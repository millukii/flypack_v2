<?php
include_once 'conexion.php';
ini_set('date.timezone', 'America/Santiago');
//delete
$SQL = "delete from shipping_request where status = 1";
$result = $conexion->query($SQL);
?>