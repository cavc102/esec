<?php 

include_once '../ConsultasDB.php';

$codigo_tarjeta   =$_GET['codigo_tarjeta'];
$descripcion      =$_GET['descripcion'];
$id_usuario     =$_GET['id_usuario'];


$db = new ConsultasDB();
$response = $db->setTarjeta($codigo_tarjeta,$descripcion,$id_usuario);

ob_clean ();
echo "finalizo";

?>