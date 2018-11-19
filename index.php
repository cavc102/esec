<?php
session_start();
include_once 'ConsultasDB.php';

$nologin=false;
if(isset($_SESSION['login'])){
  if($_SESSION['login']=='true'){
    $nologin=true;
  }
}

if($nologin==false){
    header('Location: '.'login.php');
}else{
 /*   $db = new ConsultasDB();
    $response = $db->getCountUser();
    $json  =json_encode($response,JSON_PRETTY_PRINT);
    
    $datos      =json_decode($json);
    $datos      =$datos[0];
    $cantidad   =$datos->cantidad;
    
    
    $db = new ConsultasDB();
    $response = $db->getAtendidos();
    $json  =json_encode($response,JSON_PRETTY_PRINT);
    
    $datos      =json_decode($json);
    $datos      =$datos[0];
    $atendidos   =$datos->atendidos;
    
    $db = new ConsultasDB();
    $response = $db->getRecargas();
    $json  =json_encode($response,JSON_PRETTY_PRINT);
    
    $datos      =json_decode($json);
    $datos      =$datos[0];
    $cantrecarga=$datos->cantidad;
    $valorrecarga=$datos->valor;
    
    $db = new ConsultasDB();
    $response = $db->getVenta();
    $json  =json_encode($response,JSON_PRETTY_PRINT);
    
    $datos      =json_decode($json);
    $datos      =$datos[0];
    $venta   =$datos->venta;*/
    
    $cantidad=0;
    $atendidos=0;
    $valorrecarga=0;
    $venta=0;
    $cantrecarga=0;
}


?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once './template/meta.php';?>
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
		<?php include_once './template/navbar.php';?>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        	<?php include_once './template/navmenu.php';?>

        <div class="content-inner">
          <!-- Page Header-->
          
          
          <?php include_once './template/footer.php';?>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
    <?php include_once './template/scripts.php';?>
  </body>
</html>