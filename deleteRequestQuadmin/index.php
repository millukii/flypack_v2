<?php
$host   = 'localhost';
$dbname = 'flypackroot_flypack';
$dbuser = 'flypackroot_flypack';
$dbpass = 'Leica666_';

//-------------------------------------------------------------------------------------------------------------------------------------------
try {
    $conexion = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbuser, $dbpass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
ini_set('date.timezone', 'America/Santiago');
//delete
$SQL = "delete from shipping_request where status = 1";
$result = $conexion->query($SQL);
?>