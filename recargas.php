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
    $response = $db->getRecargasAll();
    $json  =json_encode($response,JSON_PRETTY_PRINT);

    $rol=$db->getTarjetasAll();
    $json1  =json_encode($rol,JSON_PRETTY_PRINT);
    $tarjetas      =json_decode($json1);
    
    $datos      =json_decode($json);  
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
              <h2 class="no-margin-bottom">Recargas</h2>
            </div>
          </header>
          <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="exampleModalLabel" class="modal-title">Nuevo Recarga</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <form>
                  	<div class="form-group">

                      <label><b>Id Usuario</b></label>
                      <input type="text" list="lista" id="id_tarjeta" name="id_tarjeta" placeholder="nombre y tarjeta" class="form-control" required>
                      <datalist id="lista" >
		                    <?php foreach($tarjetas as $b){
                        echo "<option value='".$b->id_tarjeta."'>".$b->nombre." - ".$b->codigo_tarjeta."</option>";
                        }?>
                      </datalist>
                    </div>
                    <div class="form-group">
                      <label>Valor</label>
                      <input type="number" id="valor" name="valor" min="1" placeholder="Valor" class="form-control">
                    </div>
                    <div class="form-group">       
                      <input type="button" id="b_guardarrecarga" value="Guardar" class="btn btn-primary">
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
                  	<div class="card-header d-flex align-items-center">
                      <h3 class="h4">
                      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Nuevo</button>
                      </h3>
                    </div>
                    <div class="card-body">
                      <table id="tb_recargas" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0" >
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($datos as $a){?>
                        	<tr>
                            <th scope="row"><?=$a->id_recarga;?></th>
                            <td><?=$a->id_tarjeta;?></td>
                            <td><?=$a->fecha;?></td>
                            <td><?=$a->valor;?></td>
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