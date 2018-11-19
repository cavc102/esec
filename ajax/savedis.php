<?php 

include_once '../ConsultasDB.php';

$nombre   =$_GET['nombre'];
$marca   =$_GET['marca'];
$libras =$_GET['libras'];


$db = new ConsultasDB();
$response = $db->setDis($nombre,$marca,$libras);

ob_clean ();
echo "finalizo";

?>