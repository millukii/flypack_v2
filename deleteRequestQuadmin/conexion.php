<?php
//-------------------------------------------------------------------------------------------------------------------------------------------
// PDO
//-----------------------------------------------------------------------------------------------------------------------------------
/*
$host   = 'localhost';
$dbname = 'flypack';
$dbuser = 'root';
$dbpass = '';
*/
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
?>