<?php 

include_once '../ConsultasDB.php';

$nombre   =$_GET['usu_nombre'];
$email      =$_GET['usu_email'];
$contrasena     =$_GET['usu_pass'];
$id_rol     =$_GET['usu_rol'];
$telefono     =$_GET['usu_tel'];
$direccion     =$_GET['usu_dir'];
$identificacion = $_GET['usu_iden'];

$db = new ConsultasDB();
$response = $db->setUsuario($nombre,$email,$contrasena,$id_rol,$telefono,$direccion,$identificacion);

ob_clean ();
echo "finalizo";

?>