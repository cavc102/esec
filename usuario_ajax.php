<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'esec');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include 'pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM usuario ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'usuario.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT * FROM usuario  order by nombre LIMIT $offset,$per_page");
		
		if ($numrows>0){
			?>
		 <div class="card-body">
                      <table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>Código</th>
				  <th>Nombre</th>
				  <th>email</th>
                  <th>contraseña</th>
				  <th>rol</th>
				  <th>telefono</th>
                  <th>direccion</th>
                  <th>identificacion</th>
				  <th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['id_usuario'];?></td>
					<td><?php echo $row['nombre'];?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo $row['contrasena'];?></td>
					<td><?php echo $row['id_rol'];?></td>
					<td><?php echo $row['telefono'];?></td>
					<td><?php echo $row['direccion'];?></td>
					<td><?php echo $row['identificacion'];?></td>
					<td>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id_usuario']?>" data-nombre="<?php echo $row['nombre']?>" data-email="<?php echo $row['email']?>" data-contrasena="<?php echo $row['contrasena']?>" data-id_rol="<?php echo $row['id_rol']?>" data-telefono="<?php echo $row['telefono']?>" data-direccion="<?php echo $row['direccion']?>" data-identificacion="<?php echo $row['identificacion']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
					<!--	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
					-->
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		</div>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>