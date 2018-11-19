<?php 

include_once '../ConsultasDB.php';

$id_tarjeta   =$_GET['id_tarjeta'];
$valor   =$_GET['valor'];


$db = new ConsultasDB();
$response = $db->setRecarga($id_tarjeta,$valor);

ob_clean ();
echo "finalizo";

?>