<?php

session_start();
include_once 'ConsultasDB.php';

$user   =$_GET['user'];
$pass   =$_GET['pass'];

$db = new ConsultasDB();
$response = $db->getAuth($user,$pass);

ob_clean ();
$json  =json_encode($response,JSON_PRETTY_PRINT);

$datos  =json_decode($json);
$datos  =$datos[0];

if(isset($datos->id_usuario)){
    $_SESSION['id']=$datos->id_usuario;
    $_SESSION['name']=$datos->nombre;
    $_SESSION['password']=$datos->contrasena;
    $_SESSION['email']=$datos->email;
    $_SESSION['rol']=$datos->nombrerol;
    $_SESSION['direccion']=$datos->direccion;
    
    $_SESSION['login']="true";
}

echo $json;
 
?>