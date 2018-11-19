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
    $db = new ConsultasDB();
    $response = $db->getUsuarios();
    $json  =json_encode($response,JSON_PRETTY_PRINT);
    $datos      =json_decode($json);
  
    $rol=$db->getRoles();
    $json1  =json_encode($rol,JSON_PRETTY_PRINT);
    $roles      =json_decode($json1);

}
?>

<!DOCTYPE html>
<html>
  <head>
  <?php include_once './template/meta.php';?>
  <!--  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	Latest compiled and minified CSS
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 -->
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
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Usuarios</h2>
            </div>
          </header>
          <?php include("nuevousuario.php");?>
          <?php include("modificarusuario.php");?>
          <?php include("eliminarusuario.php");?>
          <!-- Dashboard Counts Section-->          
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            	<div class="col-lg-12">
                <div class="card">
                 	<div class="card-header d-flex align-items-center">
                    <h3 class="h4">
                      <button type="button" data-toggle="modal" data-target="#dataRegister" class="btn btn-primary"><i class='glyphicon glyphicon-plus'></i>Nuevo</button>
                    </h3>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
	                  		  <th>Código</th>
                          <th>Nombre</th>
                          <th>email</th>
                          
                          <th>rol</th>
                          <th>telefono</th>
                          <th>direccion</th>
                          <th>identificacion</th>
				                  <th colspan="2" >Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($datos as $a){?>
                       	<tr>
                          <td><?=$a->id_usuario;?></td>
                          <th scope="row"><?=$a->nombre;?></th>
                          <td><?=$a->email;?></td>
                          <td><?=$a->nombrerol;?></td>
                          <td><?=$a->telefono;?></td>
                          <td><?=$a->direccion;?></td>
                          <td><?=$a->identificacion;?></td>
                          <td ><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id_usuario="<?=$a->id_usuario?>" data-nombre="<?=$a->nombre?>" data-email="<?=$a->email?>" data-contrasena="<?=$a->contrasena?>" data-id_rol="<?=$a->id_rol?>" data-telefono="<?=$a->telefono?>" data-direccion="<?=$a->direccion?>" data-identificacion="<?=$a->identificacion?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button></td>
                          <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id_usuario="<?=$a->id_usuario?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php include_once './template/footer.php';?>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
    <?php include_once './template/scripts.php';?>
	  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	  <!-- Latest compiled and minified JavaScript -->
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	  <script src="js/app.js"></script>
	  <script>
		  $(document).ready(function(){
			load(1);
		  });
	  </script>
 </body>
</html>