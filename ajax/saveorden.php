<?php 
echo "entro saveorden";
include_once '../ConsultasDB.php';

$tar   =$_GET['id_tarjeta'];
$min      =$_GET['minutos'];

$db = new ConsultasDB();
$response = $db->setOrdenServicio($tar,$min);

ob_clean ();
echo "finalizo";

?>