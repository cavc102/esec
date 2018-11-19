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
    $response = $db->getOrdenesServicioAll();
    $json=json_encode($response,JSON_PRETTY_PRINT);
    $datos=json_decode($json);
    $id_usuario=$_SESSION['id'];
    $rol=$db->getTarjetas($id_usuario);
    $json1=json_encode($rol,JSON_PRETTY_PRINT);
    $tarjetas=json_decode($json1);

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
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Ordenes De Servicio</h2>
            </div>
          </header>
          <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="exampleModalLabel" class="modal-title">Nueva orden de servicio</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <form>
                  	<div class="form-group">       
                      <label>Tarjeta</label>
                      <select name="id_tarjeta" class="form-control" id="id_tarjeta">
		                    <option value=''>Seleccionar Una Tarjeta</option>
                          <?php foreach($tarjetas as $b){
                          echo "<option value='".$b->id_tarjeta."'>".$b->codigo_tarjeta."-".$b->descripcion."</option>";
                          }?>
                      </select>
                    </div>
                    <div class="form-group">       
                      <label>Minutos</label>
                      <select name="minutos" class="form-control" id="minutos" >
                        <option value=''>Seleccionar Minutos A Consumir</option>
                        <option value='15'>15 Minutos A Consumir</option>
                        <option value='30'>30 Minutos A Consumir</option>
                        <option value='45'>45 Minutos A Consumir</option>
                        <option value='60'>60 Minutos A Consumir</option>
                      </select>
                    </div>
                    
                    <div class="form-group">       
                      <input type="button" id="b_guardarorden" value="Guardar" class="btn btn-primary">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            	<div class="col-lg-12">
                  <div class="card">
                  <div class="card-body">
                      <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>id tarjeta</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Saldo</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($tarjetas as $b){?>
                        	<tr>
                            <th scope="row"><?=$b->id_tarjeta;?></th>
                            <td><?=$b->codigo_tarjeta;?></td>
                            <td><?=$b->descripcion;?></td>
                            <td><?=$b->saldo;?></td>
                            
                          </tr>
                        <?php }?>
                        </tbody>
                      </table>
                    </div>
                    
                  	<div class="card-header d-flex align-items-center">
                      <h3 class="h4">
                      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Nueva Orden</button>
                      </h3>
                    </div>
                    <div class="card-body">
                      <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>id tarjeta</th>
                            <th>Minutos</th>
                            <th>Estado</th>
                            <th>Fecha Orden</th>
                            <th>Fecha Consumo</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($datos as $a){?>
                        	<tr>
                            <th scope="row"><?=$a->id_tarjeta;?></th>
                            <td><?=$a->minutos;?></td>
                            <td><?=$a->estado;?></td>
                            <td><?=$a->fecha_orden;?></td>
                            <td><?=$a->fecha_consumo;?></td>
                            
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
   

  </body>
</html>