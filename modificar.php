<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 27-02-2016
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
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_usuario'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "nombre vacío";
		} else if (empty($_POST['email'])){
			$errors[] = "email vacío";
		} else if (empty($_POST['contrasena'])){
			$errors[] = "Contrasena vacía";
		} else if (empty($_POST['id_rol'])){
			$errors[] = "Rol vacío";
		} else if (empty($_POST['telefono'])){
			$errors[] = "Telefono vacío";
		} else if (empty($_POST['direccion'])){
				$errors[] = "Direccion vacío";
		} else if (empty($_POST['identificacion'])){
					$errors[] = "Identificacion vacía";
		}   else if (
			!empty($_POST['id_usuario']) &&
			!empty($_POST['nombre']) && 
			!empty($_POST['email']) &&
			!empty($_POST['contrasena']) &&
			!empty($_POST['id_rol']) &&
			!empty($_POST['telefono'])&&
			!empty($_POST['direccion'])&&
			!empty($_POST['identificacion'])
			
		){

		// escaping, additionally removing everything that could be (html/javascript-) code

		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$contrasena=mysqli_real_escape_string($con,(strip_tags($_POST["contrasena"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$id_usuario=intval($_POST['id_usuario']);
		$id_rol=intval($_POST['id_rol']);
		$identificacion=intval($_POST['identificacion']);
		$sql="UPDATE usuario SET  contrasena='".$contrasena."', id_rol='".$id_rol."', telefono='".$telefono."' where email='".$email."' and identificacion = '".$identificacion."' and id_usuario='".$id_usuario."';";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Los datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>